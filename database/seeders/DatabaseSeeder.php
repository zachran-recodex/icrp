<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersRolesAndPermissionsSeeder::class,
            HeroSectionSeeder::class,
            CategorySeeder::class,
            ArticleSeeder::class,
            EventSeeder::class,
            LibrarySeeder::class,
            CallToActionSeeder::class,
            ProgramSeeder::class,
            FounderSeeder::class,
            ManagementSeeder::class,
        ]);
    }
}
