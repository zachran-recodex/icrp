<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Advertisement::create([
            'image' => null, // Akan diisi melalui dashboard
            'is_active' => true,
        ]);
    }
}
