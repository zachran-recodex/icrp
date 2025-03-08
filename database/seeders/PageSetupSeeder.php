<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data untuk di-seed
        $pages = [
            [
                'page' => 'beranda',
                'title' => 'Beranda',
                'meta_description' => 'Halaman beranda ICRP',
                'meta_keywords' => 'beranda, icrp, home',
            ],
            [
                'page' => 'tentang',
                'title' => 'Tentang Kami',
                'meta_description' => 'Halaman tentang kami ICRP',
                'meta_keywords' => 'tentang, icrp, about',
            ],
            [
                'page' => 'pendiri',
                'title' => 'Profil Pendiri ICRP',
                'meta_description' => 'Halaman profil pendiri ICRP',
                'meta_keywords' => 'pendiri, icrp, founder',
            ],
            [
                'page' => 'pengurus',
                'title' => 'Pengurus ICRP',
                'meta_description' => 'Halaman pengurus ICRP',
                'meta_keywords' => 'pengurus, icrp, management',
            ],
            [
                'page' => 'kontak',
                'title' => 'Kontak Kami',
                'meta_description' => 'Halaman kontak kami ICRP',
                'meta_keywords' => 'kontak, icrp, contact',
            ],
            [
                'page' => 'sahabat',
                'title' => 'Sahabat ICRP',
                'meta_description' => 'Halaman sahabat ICRP',
                'meta_keywords' => 'sahabat, icrp, friends',
            ],
            [
                'page' => 'jaringan',
                'title' => 'Jaringan',
                'meta_description' => 'Halaman jaringan ICRP',
                'meta_keywords' => 'jaringan, icrp, network',
            ],
            [
                'page' => 'berita',
                'title' => 'Berita & Artikel',
                'meta_description' => 'Halaman berita dan artikel ICRP',
                'meta_keywords' => 'berita, artikel, icrp, news',
            ],
            [
                'page' => 'pustaka',
                'title' => 'Pustaka',
                'meta_description' => 'Halaman pustaka ICRP',
                'meta_keywords' => 'pustaka, icrp, library',
            ],
            [
                'page' => 'advokasi',
                'title' => 'Advokasi KBB',
                'meta_description' => 'Halaman advokasi kebebasan beragama dan berkeyakinan ICRP',
                'meta_keywords' => 'advokasi, kbb, icrp, advocacy',
            ],
        ];

        // Insert data ke tabel page_setups
        DB::table('page_setups')->insert($pages);
    }
}
