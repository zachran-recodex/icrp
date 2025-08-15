<?php

namespace Database\Seeders;

use App\Models\Founder;
use Illuminate\Database\Seeder;

class FounderSeeder extends Seeder
{
    public function run(): void
    {
        Founder::create([
            'name' => 'Prof. Dr. B.J. Habibie',
            'nickname' => 'Eyang Habibie',
            'birth_date' => '1936-06-25',
            'death_date' => '2019-09-11',
            'birth_place' => 'Parepare, Sulawesi Selatan',
            'known_as' => 'Presiden ke-3 RI dan Bapak Teknologi Indonesia',
            'quote' => 'Mulailah dengan melakukan apa yang diperlukan, kemudian lakukan apa yang mungkin, dan tiba-tiba kamu akan melakukan yang mustahil.',
            'biography' => 'Bacharuddin Jusuf Habibie adalah tokoh yang dikenal sebagai Bapak Teknologi Indonesia. Beliau adalah seorang insinyur penerbangan yang berprestasi internasional dan menjabat sebagai Presiden Republik Indonesia ke-3. Habibie dikenal atas kontribusinya dalam pengembangan teknologi penerbangan dan sebagai pendiri berbagai lembaga riset di Indonesia.',
            'photo' => 'images/book.png',
        ]);

        Founder::create([
            'name' => 'Prof. Dr. Ir. Soekarno',
            'nickname' => 'Bung Karno',
            'birth_date' => '1901-06-06',
            'death_date' => '1970-06-21',
            'birth_place' => 'Surabaya, Jawa Timur',
            'known_as' => 'Proklamator dan Presiden Pertama Republik Indonesia',
            'quote' => 'Bangsa yang besar adalah bangsa yang menghormati jasa pahlawannya.',
            'biography' => 'Ir. Soekarno adalah proklamator kemerdekaan Indonesia dan Presiden pertama Republik Indonesia. Beliau juga dikenal sebagai pemikir dan arsitek yang memiliki visi besar tentang Indonesia merdeka. Soekarno berperan penting dalam perjuangan kemerdekaan dan pembentukan dasar-dasar negara Indonesia.',
            'photo' => 'images/hero.jpeg',
        ]);

        Founder::create([
            'name' => 'Prof. Dr. Mohammad Hatta',
            'nickname' => 'Bung Hatta',
            'birth_date' => '1902-08-12',
            'death_date' => '1980-03-14',
            'birth_place' => 'Bukittinggi, Sumatera Barat',
            'known_as' => 'Proklamator dan Wakil Presiden Pertama RI',
            'quote' => 'Koperasi adalah soko guru perekonomian Indonesia.',
            'biography' => 'Mohammad Hatta adalah proklamator kemerdekaan Indonesia bersama Soekarno dan menjabat sebagai Wakil Presiden pertama. Beliau dikenal sebagai Bapak Koperasi Indonesia dan memiliki pemikiran ekonomi yang kuat. Hatta juga berperan dalam merumuskan dasar-dasar ekonomi kerakyatan Indonesia.',
            'photo' => 'images/sahabat.png',
        ]);

        Founder::create([
            'name' => 'Dr. Ir. Wernher von Braun',
            'nickname' => null,
            'birth_date' => '1912-03-23',
            'death_date' => '1977-06-16',
            'birth_place' => 'Wirsitz, Prussia (sekarang Wyrzysk, Polandia)',
            'known_as' => 'Pelopor Teknologi Roket dan Program Antariksa',
            'quote' => 'I have learned to use the word impossible with the greatest caution.',
            'biography' => 'Wernher von Braun adalah insinyur roket Jerman-Amerika yang memainkan peran kunci dalam pengembangan teknologi roket di Amerika Serikat. Beliau memimpin tim yang mengembangkan roket Saturn V yang membawa manusia ke bulan. Von Braun adalah inspirasi bagi pengembangan teknologi antariksa dan riset advanced technology.',
            'photo' => 'images/boox.png',
        ]);
    }
}
