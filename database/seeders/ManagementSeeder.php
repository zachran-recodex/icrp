<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Management;

class ManagementSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        $members = [
            // Dewan Kehormatan
            ['image' => 'images/dewan.png', 'name' => 'Musdah Mulia', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Kehormatan'],
            ['image' => 'images/dewan.png', 'name' => 'AA Yewango', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Kehormatan'],
            ['image' => 'images/dewan.png', 'name' => 'Budi Santoso Tanuwibowo', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Kehormatan'],
            ['image' => 'images/dewan.png', 'name' => 'Gandhi Sulistyanto', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Kehormatan'],
            ['image' => 'images/dewan.png', 'name' => 'Muhammad Najib', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Kehormatan'],
            ['image' => 'images/dewan.png', 'name' => 'Kardinal Suharyo', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Kehormatan'],
            ['image' => 'images/dewan.png', 'name' => 'P. Djatjukusuma', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Kehormatan'],
            ['image' => 'images/dewan.png', 'name' => 'Sudhamek AWS', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Kehormatan'],

            // Dewan Pembina
            ['image' => 'images/dewan.png', 'name' => 'Gomar Gultom', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pembina'],
            ['image' => 'images/dewan.png', 'name' => 'Amanda D. Suharnoko', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pembina'],
            ['image' => 'images/dewan.png', 'name' => 'Arilyanus Larosa', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pembina'],
            ['image' => 'images/dewan.png', 'name' => 'Biksu Dharmavimala', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pembina'],
            ['image' => 'images/dewan.png', 'name' => 'Haris Chandra', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pembina'],
            ['image' => 'images/dewan.png', 'name' => 'Michael Utama Purnama', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pembina'],
            ['image' => 'images/dewan.png', 'name' => 'Zafrullah Ahmad Ponto', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pembina'],

            // Dewan Pengawas
            ['image' => 'images/dewan.png', 'name' => 'Johannes Hariyanto', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengawas'],
            ['image' => 'images/dewan.png', 'name' => 'Wendah Soetomo', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengawas'],
            ['image' => 'images/dewan.png', 'name' => 'William Kwan', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengawas'],

            // Dewan Pengurus Harian
            ['image' => 'images/dewan.png', 'name' => 'Abdul Mu\'ti', 'position' => 'Ketua Umum', 'description' => '', 'dewan' => 'Pengurus Harian'],
            ['image' => 'images/dewan.png', 'name' => 'Ulil Abshar Abdalla', 'position' => 'Ketua 1', 'description' => '', 'dewan' => 'Pengurus Harian'],
            ['image' => 'images/dewan.png', 'name' => 'Sylvana Maria Apituley', 'position' => 'Ketua 2', 'description' => '', 'dewan' => 'Pengurus Harian'],
            ['image' => 'images/dewan.png', 'name' => 'Chandra Setiawan', 'position' => 'Ketua 3', 'description' => '', 'dewan' => 'Pengurus Harian'],
            ['image' => 'images/dewan.png', 'name' => 'Anick HT', 'position' => 'Sekretaris Jenderal', 'description' => '', 'dewan' => 'Pengurus Harian'],
            ['image' => 'images/dewan.png', 'name' => 'Erry Sutandi', 'position' => 'Sekretaris 1', 'description' => '', 'dewan' => 'Pengurus Harian'],
            ['image' => 'images/dewan.png', 'name' => 'Ilma Sovri Yanti Ilyas', 'position' => 'Sekretaris 2', 'description' => '', 'dewan' => 'Pengurus Harian'],
            ['image' => 'images/dewan.png', 'name' => 'Vincent Saputra', 'position' => 'Bendahara', 'description' => '', 'dewan' => 'Pengurus Harian'],
            ['image' => 'images/dewan.png', 'name' => 'Nia Sjarifuddin', 'position' => 'Wakil Bendahara 1', 'description' => '', 'dewan' => 'Pengurus Harian'],
            ['image' => 'images/dewan.png', 'name' => 'Januardi', 'position' => 'Wakil Bendahara 2', 'description' => '', 'dewan' => 'Pengurus Harian'],

            // Anggota
            ['image' => 'images/dewan.png', 'name' => 'Ahmad Suaedy', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengurus'],
            ['image' => 'images/dewan.png', 'name' => 'Amardeep Singh', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengurus'],
            ['image' => 'images/dewan.png', 'name' => 'Baby Jim Aditya', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengurus'],
            ['image' => 'images/dewan.png', 'name' => 'Dewi Kanti', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengurus'],
            ['image' => 'images/dewan.png', 'name' => 'Engkus Ruswana', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengurus'],
            ['image' => 'images/dewan.png', 'name' => 'Henry Gunawan Chandra', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengurus'],
            ['image' => 'images/dewan.png', 'name' => 'Justina Rostiawati', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengurus'],
            ['image' => 'images/dewan.png', 'name' => 'Muhammad Iqbal', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengurus'],
            ['image' => 'images/dewan.png', 'name' => 'Rahmi Alfiah Nur Alam', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengurus'],
            ['image' => 'images/dewan.png', 'name' => 'Yaakov Baruch', 'position' => 'Anggota', 'description' => '', 'dewan' => 'Pengurus'],
        ];

        foreach ($members as $member) {
            Management::create($member);
        }
    }
}
