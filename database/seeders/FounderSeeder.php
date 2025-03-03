<?php

namespace Database\Seeders;

use App\Models\Founder;
use Illuminate\Database\Seeder;

class FounderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $founders = [
            ['image' => 'images/founder.png', 'name' => 'K.H. Abdurrahman Wahid', 'description' => 'Pendiri organisasi.'],
            ['image' => 'images/founder.png', 'name' => 'Budi Santoso Tanuwibowo', 'description' => 'Pendiri organisasi.'],
            ['image' => 'images/founder.png', 'name' => 'Chandra Setiawan', 'description' => 'Pendiri organisasi.'],
            ['image' => 'images/founder.png', 'name' => 'Djohan Effendi', 'description' => 'Pendiri organisasi.'],
            ['image' => 'images/founder.png', 'name' => 'Gede Natih', 'description' => 'Pendiri organisasi.'],
            ['image' => 'images/founder.png', 'name' => 'Haris Chandra', 'description' => 'Pendiri organisasi.'],
            ['image' => 'images/founder.png', 'name' => 'J. N. Hariyanto', 'description' => 'Pendiri organisasi.'],
            ['image' => 'images/founder.png', 'name' => 'Michael Utama Purnama', 'description' => 'Pendiri organisasi.'],
            ['image' => 'images/founder.png', 'name' => 'Muhammad Najib', 'description' => 'Pendiri organisasi.'],
            ['image' => 'images/founder.png', 'name' => 'Musdah Mulia', 'description' => 'Pendiri organisasi.'],
            ['image' => 'images/founder.png', 'name' => 'Sudhamek AWS', 'description' => 'Pendiri organisasi.'],
            ['image' => 'images/founder.png', 'name' => 'Sylvana Maria-Apituley', 'description' => 'Pendiri organisasi.'],
        ];

        foreach ($founders as $founder) {
            Founder::create($founder);
        }
    }
}
