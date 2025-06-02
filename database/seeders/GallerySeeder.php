<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GallerySeeder extends Seeder
{
    use Helper;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Ensure image.zip is in database/seeders/data/
        $this->unzip("gallery.zip", "gallery");

        $this->makeCollectionfromJSON($this->dataPath("gallery.json"))->each(function ($gallery) {

            // Ensure $gallery->image is an array
            // process image before saving
            $storagePath = $this->process_image($gallery->iamge, "", 'gallery');

            if ($storagePath) { // Check if image processing was successful
                $saved_gallery = Gallery::create([
                    'title' => $gallery->title,
                    'path' => $storagePath,
                    'created_at' => $gallery->date,
                    'updated_at' => $gallery->date,
                ]);

                // check the category exist. If doesnt create one
                $category = Category::firstOrCreate([
                    'name' => $gallery->category,
                ]);

                $saved_gallery->category()->associate($category)->save();
            }
        });

        // Clean up the extracted images directory after all gallery items are processed
        File::deleteDirectory($this->dataPath("images"));
        // Optionally, delete the zip file itself if it's no longer needed
        // File::delete($this->dataPath("image.zip"));
    }
}
