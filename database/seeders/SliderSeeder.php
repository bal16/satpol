<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SliderSeeder extends Seeder
{
    use Helper;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->unzip("sliders.zip", "sliders");

        for ($i = 1; $i <= 5; $i++) {
            $storagePath = $this->process_image("$i.webp", "", 'sliders');
            Slider::factory()->create([
                'slot_number' => $i,
                'image_path' => $storagePath
            ]);
        }

        File::deleteDirectory($this->dataPath("images"));

    }
}
