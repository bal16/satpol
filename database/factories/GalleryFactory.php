<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(rand(3, 7)),
            'path' => $this->faker->imageUrl(640, 480, 'cats', true, 'Faker'), // Generates a placeholder image URL
            'category' => $this->faker->word(), // Generates a random word for category
        ];
    }
}
