<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ArticleCategory::all();

        Article::create([
            'title' => 'Perkembangan Penelitian AI di Indonesia',
            'content' => 'Artificial Intelligence (AI) telah menjadi salah satu bidang yang berkembang pesat di Indonesia. Berbagai universitas dan institusi penelitian telah mulai mengembangkan teknologi AI untuk berbagai keperluan, mulai dari pengenalan wajah hingga analisis data besar.',
            'image' => 'images/book.png',
            'article_category_id' => $categories->where('title', 'Penelitian')->first()->id,
        ]);

        Article::create([
            'title' => 'Revolusi Digital dalam Pendidikan',
            'content' => 'Pendidikan digital telah mengubah cara kita belajar dan mengajar. Platform pembelajaran online, aplikasi mobile, dan teknologi VR/AR memberikan pengalaman belajar yang lebih interaktif dan engaging bagi siswa di era modern.',
            'image' => 'images/boox.png',
            'article_category_id' => $categories->where('title', 'Pendidikan')->first()->id,
        ]);

        Article::create([
            'title' => 'Terobosan Teknologi Kesehatan Terkini',
            'content' => 'Teknologi kesehatan terus berkembang dengan inovasi-inovasi baru seperti telemedicine, wearable devices, dan AI diagnostics. Hal ini memungkinkan pelayanan kesehatan yang lebih efisien dan accessible untuk masyarakat luas.',
            'image' => 'images/sahabat.png',
            'article_category_id' => $categories->where('title', 'Kesehatan')->first()->id,
        ]);
    }
}
