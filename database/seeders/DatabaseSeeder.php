<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            HeroSeeder::class,
            ArticleCategorySeeder::class,
            ArticleSeeder::class,
            EventSeeder::class,
            FounderSeeder::class,
            MemberSeeder::class,
            LibrarySeeder::class,
            CallToActionSeeder::class,
            AdvocacySeeder::class,
            ProgramSeeder::class,
            AdvertisementSeeder::class,
        ]);
    }
}
