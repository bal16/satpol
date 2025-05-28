<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slot_number' => $this->faker->numberBetween(1, 5),
            'image_path' => $this->faker->imageUrl(640, 480, 'cats', true, 'Faker'),
        ];
    }
}