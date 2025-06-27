<?php

namespace Database\Factories;

use App\Models\Service; // Import the Service model
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceItem>
 */
class ServiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::factory(), // Menghubungkan ke Service
            'text' => fake()->sentence(),
            'href' => fake()->optional()->url(),
        ];
    }
}