<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'image' => 'images/test.jpg',
            'article_category_id' => \App\Models\ArticleCategory::factory(),
            'published_at' => fake()->optional()->dateTimeBetween('-1 year', '+1 month'),
        ];
    }
}
