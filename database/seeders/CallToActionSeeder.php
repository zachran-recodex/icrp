<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CallToAction;

class CallToActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CallToAction::create([
            'title' => 'Bergabunglah dengan ICRP',
            'subtitle' => 'Bersama membangun Indonesia yang lebih baik melalui penelitian dan pengembangan yang inovatif',
            'button_text' => 'Gabung Sekarang',
            'image' => 'images/call-to-action/join-icrp.jpg'
        ]);
    }
}
