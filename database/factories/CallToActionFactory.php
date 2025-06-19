<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CallToAction>
 */
class CallToActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'subtitle' => $this->faker->sentence(8),
            'button_text' => $this->faker->words(2, true),
            'image' => 'test-cta.jpg',
        ];
    }
}
