<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $this->call([
            NewsSeeder::class,
            GallerySeeder::class,
            SliderSeeder::class,
            ProfileItemsSeeder::class,
            SOPSeeder::class,
            ServiceSeeder::class
        ]);


    }



}
