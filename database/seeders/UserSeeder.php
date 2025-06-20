<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Zachran Razendra',
            'email' => 'zachranraze@recodex.id',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@icrp.id',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);
    }
}
