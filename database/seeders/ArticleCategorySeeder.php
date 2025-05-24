<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Technology',
                'description' => 'Latest trends in technology, programming, and digital innovation.',
                'is_active' => true,
            ],
            [
                'title' => 'Business',
                'description' => 'Business strategies, entrepreneurship, and market insights.',
                'is_active' => true,
            ],
            [
                'title' => 'Health & Wellness',
                'description' => 'Health tips, wellness advice, and lifestyle improvements.',
                'is_active' => true,
            ],
            [
                'title' => 'Education',
                'description' => 'Educational resources, learning methods, and academic insights.',
                'is_active' => true,
            ],
            [
                'title' => 'Travel',
                'description' => 'Travel guides, destination reviews, and adventure stories.',
                'is_active' => true,
            ],
            [
                'title' => 'Food & Cooking',
                'description' => 'Recipes, cooking techniques, and culinary adventures.',
                'is_active' => true,
            ],
            [
                'title' => 'Lifestyle',
                'description' => 'Fashion, home decor, and personal development tips.',
                'is_active' => true,
            ],
            [
                'title' => 'Sports',
                'description' => 'Sports news, fitness tips, and athletic performance.',
                'is_active' => true,
            ],
            [
                'title' => 'Science',
                'description' => 'Scientific discoveries, research findings, and innovations.',
                'is_active' => true,
            ],
            [
                'title' => 'Entertainment',
                'description' => 'Movies, music, books, and pop culture content.',
                'is_active' => false, // Inactive category for testing
            ],
        ];

        foreach ($categories as $category) {
            ArticleCategory::create($category);
        }
    }
}
