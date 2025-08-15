<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Prof. Dr. Bacharuddin Jusuf Habibie',
                'nickname' => 'BJ Habibie',
                'birth_date' => '1936-06-25',
                'death_date' => '2019-09-11',
                'birth_place' => 'Parepare, Sulawesi Selatan',
                'known_as' => 'Presiden RI ke-3, Bapak Teknologi Indonesia',
                'position' => 'Ketua Dewan Pembina',
                'dewan_category' => 'pembina',
                'quote' => 'Mulailah dengan kebenaran, gunakan cara yang benar, dan hasil yang didapat akan benar.',
                'biography' => 'Bacharuddin Jusuf Habibie adalah Presiden Republik Indonesia yang ketiga. Ia dikenal sebagai Bapak Teknologi Indonesia karena kontribusinya yang besar dalam bidang teknologi pesawat terbang.',
                'photo' => 'images/members/habibie.jpg',
            ],
            [
                'name' => 'Prof. Dr. Emil Salim',
                'nickname' => null,
                'birth_date' => '1930-06-08',
                'death_date' => null,
                'birth_place' => 'Lahat, Sumatera Selatan',
                'known_as' => 'Menteri Lingkungan Hidup Pertama Indonesia',
                'position' => 'Anggota Dewan Kehormatan',
                'dewan_category' => 'kehormatan',
                'quote' => 'Pembangunan berkelanjutan adalah pembangunan yang memenuhi kebutuhan generasi sekarang tanpa mengorbankan kemampuan generasi mendatang.',
                'biography' => 'Emil Salim adalah ekonom dan politikus Indonesia yang menjadi Menteri Lingkungan Hidup pertama Indonesia. Ia dikenal sebagai pelopor gerakan lingkungan hidup di Indonesia.',
                'photo' => 'images/members/emil-salim.jpg',
            ],
            [
                'name' => 'Dr. Sri Mulyani Indrawati',
                'nickname' => 'Sri Mulyani',
                'birth_date' => '1962-08-26',
                'death_date' => null,
                'birth_place' => 'Bandar Lampung, Lampung',
                'known_as' => 'Menteri Keuangan RI',
                'position' => 'Direktur Eksekutif',
                'dewan_category' => 'direktur eksekutif',
                'quote' => 'Reformasi struktural memerlukan konsistensi dan komitmen jangka panjang.',
                'biography' => 'Sri Mulyani Indrawati adalah ekonom dan politikus Indonesia yang menjabat sebagai Menteri Keuangan. Ia dikenal karena reformasi ekonomi dan fiskal yang dilakukannya.',
                'photo' => 'images/members/sri-mulyani.jpg',
            ],
            [
                'name' => 'Prof. Dr. Ir. Andi Hakim Nasoetion',
                'nickname' => 'Andi Hakim',
                'birth_date' => '1927-10-07',
                'death_date' => '2010-02-18',
                'birth_place' => 'Makassar, Sulawesi Selatan',
                'known_as' => 'Rektor IPB, Ahli Pertanian',
                'position' => 'Ketua Dewan Pengawas',
                'dewan_category' => 'pengawas',
                'quote' => 'Pendidikan tinggi harus mampu menghasilkan pemimpin yang berintegritas.',
                'biography' => 'Andi Hakim Nasoetion adalah akademisi dan ahli pertanian Indonesia. Ia pernah menjabat sebagai Rektor Institut Pertanian Bogor dan berkontribusi besar dalam pengembangan pendidikan tinggi Indonesia.',
                'photo' => 'images/members/andi-hakim.jpg',
            ],
            [
                'name' => 'Dr. Taufiq Kiemas',
                'nickname' => null,
                'birth_date' => '1942-11-08',
                'death_date' => '2013-06-08',
                'birth_place' => 'Palembang, Sumatera Selatan',
                'known_as' => 'Ketua MPR RI',
                'position' => 'Sekretaris Pengurus',
                'dewan_category' => 'pengurus',
                'quote' => 'Demokrasi adalah sistem yang memerlukan partisipasi aktif seluruh rakyat.',
                'biography' => 'Taufiq Kiemas adalah politikus Indonesia yang pernah menjabat sebagai Ketua MPR RI. Ia dikenal sebagai tokoh reformasi dan demokratisasi di Indonesia.',
                'photo' => 'images/members/taufiq-kiemas.jpg',
            ],
            [
                'name' => 'Prof. Dr. Ir. Khoirul Anwar',
                'nickname' => 'Khoirul Anwar',
                'birth_date' => '1978-08-28',
                'death_date' => null,
                'birth_place' => 'Kediri, Jawa Timur',
                'known_as' => 'Penemu Teknologi 4G',
                'position' => 'Koordinator Pengurus Harian',
                'dewan_category' => 'pengurus harian',
                'quote' => 'Inovasi adalah kunci untuk memajukan bangsa di era digital.',
                'biography' => 'Khoirul Anwar adalah peneliti dan penemu Indonesia yang menciptakan teknologi OFDM untuk 4G. Ia dikenal sebagai salah satu ilmuwan muda terbaik Indonesia.',
                'photo' => 'images/members/khoirul-anwar.jpg',
            ],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
