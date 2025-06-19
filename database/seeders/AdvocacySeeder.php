<?php

namespace Database\Seeders;

use App\Models\Advocacy;
use Illuminate\Database\Seeder;

class AdvocacySeeder extends Seeder
{
    public function run(): void
    {
        Advocacy::create([
            'title' => 'Advokasi Penelitian dan Inovasi Berkelanjutan',
            'content' => 'Kami berkomitmen untuk mendorong penelitian dan inovasi yang berkelanjutan di Indonesia. Melalui program advokasi ini, kami mengajak berbagai pihak untuk berpartisipasi dalam mengembangkan penelitian yang berdampak positif bagi masyarakat dan lingkungan.',
            'image' => 'images/book.png',
        ]);

        Advocacy::create([
            'title' => 'Pemberdayaan Komunitas Peneliti Muda',
            'content' => 'Program advokasi untuk memberdayakan para peneliti muda Indonesia agar dapat berkontribusi lebih maksimal dalam dunia penelitian. Kami menyediakan platform dan dukungan untuk mengembangkan potensi mereka di bidang riset dan inovasi.',
            'image' => 'images/boox.png',
        ]);

        Advocacy::create([
            'title' => 'Kolaborasi Riset Internasional',
            'content' => 'Mendorong terciptanya kolaborasi riset antara peneliti Indonesia dengan peneliti internasional. Program ini bertujuan untuk meningkatkan kualitas penelitian dan memperluas jaringan kerjasama di tingkat global.',
            'image' => 'images/sahabat.png',
        ]);
    }
}
