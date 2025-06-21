# Deployment Guide - cPanel Shared Hosting (Improved Structure)

Panduan deployment terstruktur untuk aplikasi ICRP Laravel di shared hosting cPanel tanpa akses terminal.

## Struktur Deployment yang Disarankan

### Fase 1: Persiapan (Development)

#### 1.1 Pre-deployment Checklist
```bash
# Jalankan di local sebelum deploy
npm run build                   # Build assets untuk production
./vendor/bin/pest               # Pastikan semua test pass
php artisan optimize:clear      # Clear all
```

#### 1.2 Buat Branch Deployment
```bash
git checkout -b production
git add .
git commit -m "Prepare for production deployment"
git push origin production
```

#### 1.3 Siapkan File Deployment
- Export database dengan struktur dan data
- Zip folder `vendor` untuk upload
- Buat `.env.production` sebagai template

### Fase 2: Setup Server (cPanel)

#### 2.1 Clone Repository (Improved)
```
cPanel → Git Version Control → Create
Repository URL: https://github.com/username/icrp.git
Branch: production (bukan main)
Repository Path: /home/recodex/public_html/subdomain/icrp.id
```

#### 2.2 Struktur Direktori yang Disarankan
```
/home/recodex/public_html/subdomain/icrp.id/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/          # Folder ini yang akan diakses web
├── resources/
├── routes/
├── storage/
├── vendor/          # Upload manual
├── .env            # Buat manual
├── .htaccess       # Penting untuk routing
└── artisan
```

### Fase 3: Konfigurasi Database & Environment

#### 3.1 Setup Database (Structured)
1. **Buat Database**
   ```
   cPanel → MySQL Databases
   - Database Name: recodex_icrp_prod
   - Username: recodex_icrp_user
   - Password: [secure_password]
   - Grant All Privileges
   ```

2. **Import Database**
   ```
   phpMyAdmin → Import
   - Pilih file SQL dari local
   - Character set: utf8mb4_unicode_ci
   - Execute
   ```

#### 3.2 Environment Configuration
Buat file `.env` dengan konfigurasi production-ready:

```env
# Application
APP_NAME="ICRP"
APP_ENV=production
APP_KEY=[generate_new_key]
APP_DEBUG=false
APP_TIMEZONE=Asia/Jakarta
APP_URL=https://icrp.id

# Database
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=recodex_icrp_prod
DB_USERNAME=recodex_icrp_user
DB_PASSWORD=[your_secure_password]

# Cache & Session (File-based untuk shared hosting)
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Mail (Sesuaikan dengan provider hosting)
MAIL_MAILER=smtp
MAIL_HOST=mail.icrp.id
MAIL_PORT=587
MAIL_USERNAME=noreply@icrp.id
MAIL_PASSWORD=[mail_password]
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@icrp.id
MAIL_FROM_NAME="ICRP"

# Logging
LOG_CHANNEL=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error
```

### Fase 4: File Management & Permissions

#### 4.1 Upload Dependencies
```
File Manager → /home/recodex/public_html/subdomain/icrp.id/
1. Upload vendor.zip
2. Extract vendor folder
3. Set permissions:
   - storage/: 755
   - bootstrap/cache/: 755
   - .env: 644
```

#### 4.2 Storage Symlink (Automated)
Buat file script `create-symlink.php` di root:
```php
<?php
// create-symlink.php
$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

if (!file_exists($link)) {
    symlink($target, $link);
    echo "Storage symlink created successfully!";
} else {
    echo "Storage symlink already exists.";
}
?>
```

Jalankan via browser: `https://icrp.id/create-symlink.php`

### Fase 5: Web Server Configuration

#### 5.1 .htaccess Configuration
Pastikan file `.htaccess` di folder `public/`:
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

# Security Headers
<IfModule mod_headers.c>
    Header always set X-Content-Type-Options nosniff
    Header always set X-Frame-Options DENY
    Header always set X-XSS-Protection "1; mode=block"
</IfModule>

# Disable access to sensitive files
<Files ".env">
    Order allow,deny
    Deny from all
</Files>
```

#### 5.2 Subdomain Configuration
Jika menggunakan subdomain, pastikan Document Root menunjuk ke:
```
/home/recodex/public_html/subdomain/icrp.id/public
```

### Fase 6: Automation & Maintenance

#### 6.1 Auto-deployment Script
Buat file `deploy.php` untuk otomatisasi:
```php
<?php
// deploy.php - Webhook untuk auto-deploy
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = json_decode(file_get_contents('php://input'), true);
    
    if (isset($payload['ref']) && $payload['ref'] === 'refs/heads/production') {
        // Pull latest changes
        exec('cd /home/recodex/public_html/subdomain/icrp.id && git pull origin production 2>&1', $output);
        
        // Clear caches
        exec('php artisan config:clear');
        exec('php artisan route:clear');
        exec('php artisan view:clear');
        
        echo "Deployment successful!\n";
        echo implode("\n", $output);
    }
}
?>
```

#### 6.2 Cron Jobs untuk Maintenance
```
# Clear cache setiap hari jam 2 pagi
0 2 * * * php /home/recodex/public_html/subdomain/icrp.id/artisan config:clear

# Backup database setiap minggu
0 3 * * 0 mysqldump -u recodex_icrp_user -p[password] recodex_icrp_prod > /home/recodex/backups/icrp_$(date +\%Y\%m\%d).sql
```

### Fase 7: Monitoring & Security

#### 7.1 Health Check Script
Buat `health-check.php`:
```php
<?php
// health-check.php
$checks = [
    'Database' => false,
    'Storage' => false,
    'Cache' => false
];

try {
    // Check database
    $pdo = new PDO("mysql:host=localhost;dbname=recodex_icrp_prod", "recodex_icrp_user", "[password]");
    $checks['Database'] = true;
} catch (Exception $e) {
    // Database check failed
}

// Check storage symlink
$checks['Storage'] = is_link(__DIR__ . '/public/storage');

// Check cache directory
$checks['Cache'] = is_writable(__DIR__ . '/bootstrap/cache');

header('Content-Type: application/json');
echo json_encode($checks);
?>
```

#### 7.2 Security Measures
1. **File Permissions**:
   - Folders: 755
   - Files: 644
   - Sensitive files (.env): 600

2. **Backup Strategy**:
   - Database backup mingguan
   - File backup bulanan
   - Version control untuk code

3. **Monitoring**:
   - Setup email alerts untuk errors
   - Monitor disk usage
   - Check aplikasi health secara berkala

## Deployment Checklist

### Pre-deployment
- [ ] Tests pass locally
- [ ] Assets built (`npm run build`)
- [ ] Database exported
- [ ] .env.production ready
- [ ] Vendor dependencies zipped

### Deployment
- [ ] Repository cloned to correct path
- [ ] Database created and imported
- [ ] .env file configured
- [ ] Vendor folder uploaded
- [ ] Permissions set correctly
- [ ] Storage symlink created
- [ ] .htaccess configured

### Post-deployment
- [ ] Website accessible
- [ ] All routes working
- [ ] Database connected
- [ ] File uploads working
- [ ] Email sending working
- [ ] Performance optimized

### Maintenance Setup
- [ ] Auto-deployment configured
- [ ] Backup cron jobs set
- [ ] Health monitoring active
- [ ] Error logging configured

## Troubleshooting

### Common Issues
1. **500 Error**: Check error logs, permissions, .env file
2. **Database Connection**: Verify credentials, database existence
3. **Missing Assets**: Ensure `npm run build` was run
4. **File Upload Issues**: Check storage permissions and symlink
5. **Route Not Found**: Verify .htaccess and web server config

### Performance Optimization
```env
# Tambahkan ke .env untuk optimasi
CACHE_DRIVER=file
SESSION_DRIVER=file
VIEW_CACHE_PATH=/home/recodex/public_html/subdomain/icrp.id/storage/framework/views
```

Dengan struktur ini, deployment akan lebih terorganisir, mudah di-maintain, dan memiliki sistem backup serta monitoring yang baik.
