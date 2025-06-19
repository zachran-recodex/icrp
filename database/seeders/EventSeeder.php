<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::create([
            'title' => 'Seminar Teknologi AI dalam Penelitian',
            'date' => '2025-07-15',
            'time' => '09:00:00',
            'location' => 'Auditorium ICRP, Jakarta',
            'description' => 'Seminar nasional tentang penerapan teknologi Artificial Intelligence dalam dunia penelitian dan pengembangan. Menghadirkan pakar AI terkemuka dari berbagai universitas dan institusi riset.',
            'image' => 'images/book.png',
        ]);

        Event::create([
            'title' => 'Workshop Digital Research Methods',
            'date' => '2025-07-22',
            'time' => '13:00:00',
            'location' => 'Lab Komputer ICRP, Bandung',
            'description' => 'Workshop praktis tentang metode penelitian digital, termasuk penggunaan software analisis data, tools visualisasi, dan platform kolaborasi online untuk meningkatkan efektivitas penelitian.',
            'image' => 'images/boox.png',
        ]);

        Event::create([
            'title' => 'Konferensi Internasional ICRP 2025',
            'date' => '2025-08-10',
            'time' => '08:00:00',
            'location' => 'Convention Center, Bali',
            'description' => 'Konferensi internasional tahunan ICRP yang menghadirkan peneliti dari seluruh dunia untuk berbagi hasil penelitian terdepan dalam berbagai bidang ilmu pengetahuan dan teknologi.',
            'image' => 'images/sahabat.png',
        ]);

        Event::create([
            'title' => 'Training Program for Young Researchers',
            'date' => '2025-08-25',
            'time' => '10:00:00',
            'location' => 'ICRP Training Center, Yogyakarta',
            'description' => 'Program pelatihan intensif untuk peneliti muda yang meliputi metodologi penelitian, penulisan ilmiah, presentasi akademik, dan strategi pengembangan karir di bidang riset.',
            'image' => 'images/hero.jpeg',
        ]);
    }
}
