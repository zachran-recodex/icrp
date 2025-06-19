# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview
Indonesian Conference on Religion and Peace (ICRP) - Laravel 12 + Livewire website for a religious peace organization featuring content management for articles, library, advocacy, member profiles, and events.

## Commands

### Development
```bash
# Start development server
php artisan serve

# Asset compilation
npm run dev          # Development with hot reload
npm run build        # Production build
npm run watch        # Watch for changes

# Database
php artisan migrate          # Run migrations
php artisan migrate:fresh    # Fresh migration
php artisan migrate:fresh --seed  # Fresh migration with seed data

# Testing
./vendor/bin/pest           # Run all tests
./vendor/bin/pest --filter ExampleTest  # Run specific test
php artisan test            # Alternative test command

# Code Quality
php artisan route:list      # List all routes
php artisan tinker          # Laravel REPL
```

### Pre-commit Requirements
- **IMPORTANT**: Always run `npm run build` before committing view changes
- Run tests with `./vendor/bin/pest` to ensure all pass
- Verify no lint errors

## Architecture

### Core Stack
- **Laravel 12** with **Livewire 3 + Volt**
- **Livewire Flux 2.1** for enhanced UI components  
- **TailwindCSS 4.0** + **Vite 6.0**
- **Pest PHP** for testing
- **Alpine.js** for client-side interactivity

### Key Models & Relationships
```
Article → ArticleCategory (BelongsTo)
Member (with dewan_category: direktur eksekutif, pengurus, kehormatan, pembina, pengawas, pengurus harian)
Founder, Library, Advocacy, Event (standalone content)
Hero, CallToAction (site configuration)
```

### URL Structure
All content models use `spatie/laravel-sluggable`:
- `/berita/{slug}` - Article details
- `/pustaka/{slug}` - Library details  
- `/advokasi/{slug}` - Advocacy details
- `/pendiri/{slug}` - Founder profiles
- `/pengurus/{slug}` - Member profiles

### Controller Pattern
**MainController** handles all public routes with consistent pattern:
```php
$heroSection = Hero::first();
$callToAction = CallToAction::first();
// + page-specific data with eager loading
```

### View Architecture
- **Main Layout**: `resources/views/components/layouts/main.blade.php`
  - Collapsible sidebar navigation with Alpine.js
  - Authentication state handling
  - FontAwesome icons, responsive design

- **Livewire Dashboard**: 8 management components in `app/Livewire/Dashboard/`
  - CRUD operations with modals, file uploads
  - Search, filtering, pagination
  - Real-time validation, flash messaging

### Database Considerations
- Development uses SQLite, production typically MySQL
- All content models have proper `fillable` arrays
- Route model binding uses slugs, not IDs
- Factory support for Hero and CallToAction models

### Testing Setup
- Uses **RefreshDatabase** trait for feature tests
- Requires factory data for Hero and CallToAction in tests
- In-memory SQLite database for test isolation
- All 27 tests should pass before commits

## Best Practices
- Always follow best practices in the `/docs` folder
- ketika membuat view dan ada perubahan pada view biasakan npm run build terlebih dahulu sebelum push repo
- Use eager loading to prevent N+1 queries: `Article::with('articleCategory')`
- Leverage Livewire computed properties for database queries
- Follow Laravel naming conventions and use route model binding
- Implement proper form validation in Livewire components
- Use HasFactory trait for all models that need testing support

## Development Notes
- Route `home` was changed to `beranda` - update any hardcoded references
- Auth layouts reference `route('beranda')` instead of `route('home')`
- Member model uses `dewan_category` field for organizational structure
- File uploads typically go to `storage/app/public/` with symbolic link