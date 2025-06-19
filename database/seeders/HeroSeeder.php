<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    public function run(): void
    {
        Hero::create([
            'title' => 'Selamat Datang di ICRP',
            'subtitle' => 'Platform terdepan untuk riset dan pengembangan',
            'image' => 'images/hero.jpeg',
        ]);
    }
}
