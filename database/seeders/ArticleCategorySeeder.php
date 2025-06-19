<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    public function run(): void
    {
        ArticleCategory::create(['title' => 'Penelitian']);
        ArticleCategory::create(['title' => 'Teknologi']);
        ArticleCategory::create(['title' => 'Pendidikan']);
        ArticleCategory::create(['title' => 'Kesehatan']);
        ArticleCategory::create(['title' => 'Umum']);
    }
}
