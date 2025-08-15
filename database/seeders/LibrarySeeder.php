<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $libraries = [
            [
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'description' => 'Novel klasik Indonesia yang bercerita tentang perjalanan hidup Minke, seorang pribumi yang berpendidikan Eropa di era kolonial Belanda. Novel ini mengangkat tema perjuangan, identitas, dan kemanusiaan dalam konteks sejarah Indonesia.',
                'image' => 'images/library/bumi-manusia.jpg',
            ],
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'description' => 'Novel yang mengisahkan tentang sepuluh anak dari keluarga miskin di Belitung yang berjuang untuk mendapatkan pendidikan. Cerita ini penuh dengan inspirasi tentang kekuatan mimpi dan pendidikan.',
                'image' => 'images/library/laskar-pelangi.jpg',
            ],
            [
                'title' => 'Negeri 5 Menara',
                'author' => 'Ahmad Fuadi',
                'description' => 'Novel inspiratif yang menceritakan perjalanan enam sahabat di Pondok Modern Darussalam Gontor. Novel ini mengajarkan tentang persahabatan, cita-cita, dan semangat untuk meraih mimpi.',
                'image' => 'images/library/negeri-5-menara.jpg',
            ],
            [
                'title' => 'Ayat-Ayat Cinta',
                'author' => 'Habiburrahman El Shirazy',
                'description' => 'Novel religi yang bercerita tentang Fahri, mahasiswa Indonesia di Universitas Al-Azhar, Kairo. Novel ini memadukan kisah cinta dengan nilai-nilai spiritual dan toleransi antar agama.',
                'image' => 'images/library/ayat-ayat-cinta.jpg',
            ],
            [
                'title' => 'Perahu Kertas',
                'author' => 'Dewi Lestari',
                'description' => 'Novel yang mengisahkan perjalanan Kugy dan Keenan dalam mencari jati diri dan cinta sejati. Cerita ini penuh dengan filosofi hidup dan makna persahabatan yang mendalam.',
                'image' => 'images/library/perahu-kertas.jpg',
            ],
            [
                'title' => 'Ronggeng Dukuh Paruk',
                'author' => 'Ahmad Tohari',
                'description' => 'Trilogi novel yang menceritakan tentang kehidupan Srintil, seorang ronggeng dari desa terpencil. Novel ini mengangkat tradisi budaya Jawa dan konflik sosial yang terjadi di masyarakat.',
                'image' => 'images/library/ronggeng-dukuh-paruk.jpg',
            ],
            [
                'title' => 'Cantik Itu Luka',
                'author' => 'Eka Kurniawan',
                'description' => 'Novel yang bercerita tentang Dewi Ayu dan keluarganya dalam rentang waktu yang panjang, dari masa kolonial hingga era reformasi. Novel ini memadukan realisme magis dengan sejarah Indonesia.',
                'image' => 'images/library/cantik-itu-luka.jpg',
            ],
            [
                'title' => 'Saman',
                'author' => 'Ayu Utami',
                'description' => 'Novel kontroversial yang mengangkat isu-isu sosial, politik, dan seksualitas di Indonesia. Cerita ini berpusat pada empat perempuan dan seorang pendeta yang terlibat dalam aktivisme sosial.',
                'image' => 'images/library/saman.jpg',
            ],
        ];

        foreach ($libraries as $library) {
            Library::create($library);
        }
    }
}
