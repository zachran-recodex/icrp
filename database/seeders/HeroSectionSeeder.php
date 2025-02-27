<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSection::create([
            'title' => 'House of Peace',
            'subtitle' => 'Dialog Antar Agama, Kemanusiaan dan Persaudaraan Lintas Iman, Rumah Perdamaian,  Agama untuk Perdamaian, Demokrasi',
            'image' => 'public/images/hero.jpeg',
        ]);
    }
}
