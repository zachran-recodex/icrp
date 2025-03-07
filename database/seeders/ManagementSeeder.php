<?php

namespace Database\Seeders;

use App\Models\Management;
use App\Models\ManagementContribution;
use App\Models\ManagementLegacy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ManagementSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Daftar lengkap pengurus ICRP
        $managements = [
            [
                'name' => 'K.H. Abdurrahman Wahid',
                'nickname' => 'Gus Dur',
                'birth_date' => '1940-09-07',
                'death_date' => '2009-12-30',
                'birth_place' => 'Jombang, Jawa Timur',
                'known_as' => 'Presiden RI ke-4, Tokoh NU',
                'quote' => 'Perbedaan bukanlah untuk dipertentangkan, tetapi untuk dipahami sehingga kita dapat saling menghormati.',
                'biography' => "K.H. Abdurrahman Wahid atau yang akrab disapa Gus Dur adalah tokoh Muslim Indonesia, pemikir, dan politisi yang pernah menjabat sebagai Presiden Indonesia ke-4 (1999-2001). Sebagai cucu dari pengurus Nahdlatul Ulama (NU), Gus Dur dikenal sebagai tokoh yang memperjuangkan pluralisme, toleransi beragama, dan demokrasi di Indonesia.\n\nGus Dur menempuh pendidikan di berbagai pesantren di Jawa kemudian melanjutkan pendidikan ke Timur Tengah dan Eropa. Pengalaman internasional ini membentuk pandangannya yang luas dan terbuka terhadap berbagai nilai dan budaya.\n\nSebagai salah satu pengurus utama Indonesian Conference on Religion and Peace, Gus Dur berdedikasi untuk membangun dialog antar agama dan mempromosikan perdamaian di Indonesia. Pemikiran dan usahanya dalam membangun jembatan antara berbagai komunitas agama telah memberikan kontribusi besar bagi terciptanya kerukunan beragama di Indonesia.",
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
            [
                'name' => 'Budi Santoso Tanuwibowo',
                'nickname' => null,
                'birth_date' => '1945-08-15', // Tanggal contoh, perlu diperbarui dengan data sebenarnya
                'death_date' => null,
                'birth_place' => 'Indonesia', // Lokasi contoh, perlu diperbarui
                'known_as' => 'Tokoh Konghucu Indonesia',
                'quote' => null,
                'biography' => 'Budi Santoso Tanuwibowo adalah salah satu tokoh Konghucu yang berkontribusi besar dalam dialog antar agama di Indonesia. Beliau aktif mempromosikan kerukunan antar umat beragama dan berkontribusi pada pembentukan ICRP.',
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
            [
                'name' => 'Chandra Setiawan',
                'nickname' => null,
                'birth_date' => '1950-01-10', // Tanggal contoh, perlu diperbarui
                'death_date' => null,
                'birth_place' => 'Indonesia', // Lokasi contoh, perlu diperbarui
                'known_as' => 'Tokoh Lintas Agama',
                'quote' => null,
                'biography' => 'Chandra Setiawan adalah aktivis dialog lintas agama yang telah berkontribusi pada berbagai inisiatif perdamaian di Indonesia. Beliau menjadi salah satu pengurus ICRP yang berdedikasi untuk mempromosikan toleransi dan saling pengertian antar umat beragama.',
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
            [
                'name' => 'Djohan Effendi',
                'nickname' => null,
                'birth_date' => '1939-10-01',
                'death_date' => '2017-11-17',
                'birth_place' => 'Kandangan, Kalimantan Selatan',
                'known_as' => 'Cendekiawan Muslim, Mantan Menteri Sekretaris Negara',
                'quote' => null,
                'biography' => 'Djohan Effendi adalah intelektual Muslim Indonesia yang dikenal dengan pemikirannya tentang pluralisme dan kebebasan beragama. Beliau pernah menjabat sebagai Menteri Sekretaris Negara pada masa pemerintahan Abdurrahman Wahid. Sebagai salah satu pengurus ICRP, Djohan Effendi memiliki komitmen yang kuat untuk membangun dialog antar agama dan mempromosikan toleransi di Indonesia.',
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
            [
                'name' => 'Gede Natih',
                'nickname' => null,
                'birth_date' => '1950-05-20', // Tanggal contoh, perlu diperbarui
                'death_date' => null,
                'birth_place' => 'Bali, Indonesia', // Lokasi contoh, perlu diperbarui
                'known_as' => 'Tokoh Hindu',
                'quote' => null,
                'biography' => 'Gede Natih adalah tokoh Hindu yang aktif dalam dialog lintas agama di Indonesia. Beliau berkontribusi pada pembentukan ICRP dan memperjuangkan nilai-nilai toleransi dan perdamaian antar umat beragama.',
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
            [
                'name' => 'Haris Chandra',
                'nickname' => null,
                'birth_date' => '1945-03-15', // Tanggal contoh, perlu diperbarui
                'death_date' => null,
                'birth_place' => 'Indonesia', // Lokasi contoh, perlu diperbarui
                'known_as' => 'Aktivis Keagamaan',
                'quote' => null,
                'biography' => 'Haris Chandra adalah aktivis keagamaan yang telah lama berkecimpung dalam upaya mendorong dialog antar agama di Indonesia. Sebagai salah satu pengurus ICRP, beliau memiliki visi untuk membangun Indonesia yang damai dan saling menghormati perbedaan.',
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
            [
                'name' => 'J. N. Hariyanto',
                'nickname' => null,
                'birth_date' => '1940-06-15', // Tanggal contoh, perlu diperbarui
                'death_date' => null,
                'birth_place' => 'Indonesia', // Lokasi contoh, perlu diperbarui
                'known_as' => 'Tokoh Gereja',
                'quote' => null,
                'biography' => 'J. N. Hariyanto adalah tokoh Gereja yang berkontribusi signifikan dalam dialog antar agama di Indonesia. Beliau merupakan salah satu pengurus ICRP yang berdedikasi untuk membangun jembatan pemahaman antar komunitas agama yang berbeda.',
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
            [
                'name' => 'Michael Utama Purnama',
                'nickname' => null,
                'birth_date' => '1955-04-22', // Tanggal contoh, perlu diperbarui
                'death_date' => null,
                'birth_place' => 'Indonesia', // Lokasi contoh, perlu diperbarui
                'known_as' => 'Tokoh Lintas Agama',
                'quote' => null,
                'biography' => 'Michael Utama Purnama adalah aktivis dialog lintas agama yang telah berkontribusi pada berbagai inisiatif untuk mempromosikan perdamaian dan kerukunan beragama di Indonesia. Sebagai pengurus ICRP, beliau memperjuangkan hak-hak kebebasan beragama dan berkeyakinan.',
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
            [
                'name' => 'Muhammad Najib',
                'nickname' => null,
                'birth_date' => '1950-09-05', // Tanggal contoh, perlu diperbarui
                'death_date' => null,
                'birth_place' => 'Indonesia', // Lokasi contoh, perlu diperbarui
                'known_as' => 'Cendekiawan Muslim',
                'quote' => null,
                'biography' => 'Muhammad Najib adalah cendekiawan Muslim yang berkontribusi pada pembentukan ICRP. Beliau aktif mempromosikan dialog antar agama dan nilai-nilai perdamaian dalam kehidupan berbangsa dan bernegara.',
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
            [
                'name' => 'Musdah Mulia',
                'nickname' => null,
                'birth_date' => '1958-03-03',
                'death_date' => null,
                'birth_place' => 'Bone, Sulawesi Selatan',
                'known_as' => 'Cendekiawan Muslim, Aktivis HAM dan Gender',
                'quote' => null,
                'biography' => 'Prof. Dr. Siti Musdah Mulia adalah cendekiawan Muslim dan aktivis hak asasi manusia yang dikenal dengan perjuangannya untuk kesetaraan gender dan kebebasan beragama. Beliau menjadi salah satu pengurus ICRP dan terus aktif mempromosikan nilai-nilai pluralisme dan toleransi di Indonesia. Musdah Mulia memiliki latar belakang akademik yang kuat dan telah menulis banyak buku tentang Islam, gender, dan hak asasi manusia.',
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
            [
                'name' => 'Sudhamek AWS',
                'nickname' => null,
                'birth_date' => '1956-12-15', // Tanggal contoh, perlu diperbarui
                'death_date' => null,
                'birth_place' => 'Indonesia', // Lokasi contoh, perlu diperbarui
                'known_as' => 'Pengusaha dan Aktivis Keagamaan',
                'quote' => null,
                'biography' => 'Sudhamek AWS adalah pengusaha sukses dan aktivis keagamaan yang berkomitmen pada dialog antar agama di Indonesia. Beliau menjadi salah satu pengurus ICRP dan berkontribusi pada upaya membangun kerukunan umat beragama melalui berbagai inisiatif.',
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
            [
                'name' => 'Sylvana Maria-Apituley',
                'nickname' => null,
                'birth_date' => '1958-08-25', // Tanggal contoh, perlu diperbarui
                'death_date' => null,
                'birth_place' => 'Indonesia', // Lokasi contoh, perlu diperbarui
                'known_as' => 'Aktivis Katolik',
                'quote' => null,
                'biography' => 'Sylvana Maria-Apituley adalah aktivis Katolik yang telah lama terlibat dalam dialog antar agama dan upaya perdamaian di Indonesia. Sebagai salah satu pengurus ICRP, beliau berdedikasi untuk mempromosikan toleransi dan saling pengertian antar umat beragama.',
                'position' => 'Anggota',
                'dewan' => 'Pengurus'
            ],
        ];

        // Kontribusi umum untuk semua pengurus
        $commonContributions = [
            [
                'title' => 'Pendirian ICRP',
                'description' => 'Menjadi salah satu pengurus Indonesian Conference on Religion and Peace',
                'order' => 1,
            ],
            [
                'title' => 'Dialog Antar-Agama',
                'description' => 'Mempromosikan dialog dan toleransi di antara berbagai kelompok agama di Indonesia',
                'order' => 2,
            ],
        ];

        // Kontribusi khusus untuk Gus Dur
        $gusDurContributions = [
            [
                'title' => 'Ketua PBNU',
                'description' => 'Memimpin Pengurus Besar Nahdlatul Ulama (PBNU) periode 1984-1999',
                'order' => 3,
            ],
            [
                'title' => 'Pembela Minoritas',
                'description' => 'Memperjuangkan hak-hak kelompok minoritas dan terpinggirkan',
                'order' => 4,
            ],
            [
                'title' => 'Pribumisasi Islam',
                'description' => 'Mengembangkan konsep yang menyelaraskan nilai Islam dengan budaya lokal',
                'order' => 5,
            ],
        ];

        // Legacy umum untuk semua pengurus
        $commonLegacy = "Sebagai salah satu pengurus Indonesian Conference on Religion and Peace (ICRP), beliau berkontribusi besar pada upaya dialog antar agama dan pembangunan perdamaian di Indonesia. Pemikiran dan usahanya dalam membangun jembatan antara berbagai komunitas agama telah memberikan kontribusi besar bagi terciptanya kerukunan beragama di Indonesia.";

        // Warisan pemikiran khusus untuk Gus Dur
        $gusDurLegacy = "Pemikiran Gus Dur tentang pluralisme dan toleransi beragama terus menjadi inspirasi bagi Indonesian Conference on Religion and Peace hingga saat ini. Beliau menekankan bahwa perdamaian hanya dapat dicapai melalui dialog terbuka, saling pengertian, dan penghormatan terhadap keberagaman.\n\nGus Dur meninggal pada 30 Desember 2009, namun warisan pemikirannya terus hidup dan dikembangkan oleh organisasi ini. Prinsip-prinsip yang beliau ajarkan tentang pentingnya menjaga kebhinekaan menjadi fondasi dalam upaya membangun kedamaian di Indonesia yang multikultur.";

        // Insert data managements ke database
        foreach ($managements as $index => $managementData) {
            $management = Management::create([
                'name' => $managementData['name'],
                'nickname' => $managementData['nickname'],
                'slug' => Str::slug($managementData['name']),
                'birth_date' => $managementData['birth_date'],
                'death_date' => $managementData['death_date'],
                'birth_place' => $managementData['birth_place'],
                'known_as' => $managementData['known_as'],
                'quote' => $managementData['quote'],
                'biography' => $managementData['biography'],
                'image' => 'images/managements/pengurus-' . ($index + 1) . '.jpg',
                'order' => $index + 1,
                'position' => $managementData['position'],
                'dewan' => $managementData['dewan'],
            ]);

            // Tambahkan kontribusi sesuai dengan pengurus
            $contributions = $commonContributions;
            if ($managementData['name'] === 'K.H. Abdurrahman Wahid') {
                $contributions = array_merge($contributions, $gusDurContributions);
            }

            foreach ($contributions as $contribution) {
                ManagementContribution::create([
                    'management_id' => $management->id,
                    'title' => $contribution['title'],
                    'description' => $contribution['description'],
                    'order' => $contribution['order'],
                ]);
            }

            // Tambahkan warisan pemikiran
            $legacyContent = $managementData['name'] === 'K.H. Abdurrahman Wahid' ? $gusDurLegacy : $commonLegacy;

            ManagementLegacy::create([
                'management_id' => $management->id,
                'content' => $legacyContent,
            ]);
        }
    }
}
