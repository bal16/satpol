<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileItems>
 */
class ProfileItemsFactory extends Factory
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
            'type' => $this->faker->randomElement(['text', 'image']),
            'content' => $this->faker->paragraphs(rand(3, 7), true),
            'show' => $this->faker->boolean(),
        ];
    }
}
