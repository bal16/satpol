<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(rand(5, 10)), // Generates a sentence with 5 to 10 words
            'body' => $this->faker->paragraphs(rand(3, 7), true), // Generates 3 to 7 paragraphs as a single string
        ];
    }
}