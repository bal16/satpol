<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'admin01',
            'email' => 'admin@example.com',
            'is_admin' => true,
            'password' => Hash::make('admin123'),
        ]);


        for ($i = 1; $i <= 5; $i++) {
            Slider::factory()->create([
                'slot_number' => $i,
                'image_path' => ''
            ]);
        }

    }
}