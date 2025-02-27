<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar nama kategori yang relevan dengan Indonesian Conference on Religion and Peace
        $categories = [
            'Interfaith Dialogue',
            'Religious Tolerance',
            'Peacebuilding',
            'Human Rights and Religion',
            'Religion and Social Justice',
            'Religion and Environment',
            'Religion and Education',
            'Religion and Politics',
            'Religion and Gender Equality',
            'Religion and Conflict Resolution',
        ];

        // Buat kategori berdasarkan daftar di atas
        foreach ($categories as $category) {
            Category::create([
                'title' => $category,
            ]);
        }
    }
}
