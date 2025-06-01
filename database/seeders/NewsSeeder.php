<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    use Helper; // Use the Helper trait

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure image.zip is in database/seeders/data/
        $this->unzip("image.zip");

        $this->makeCollectionfromJSON($this->dataPath("news.json"))->each(function ($news) {
            $saved_news = News::create([
                'title' => $news->title,
                'body' => $news->body,
                'slug' => Str::limit($news->slug, 40, ''),
                'author' => $news->author,
                'created_at' => $news->created_at,
                'updated_at' => $news->updated_at,
            ]);

            // Ensure $news->image is an array
            if (is_array($news->image)) {
                foreach ($news->image as $imageFilename) {
                    // Pass the image filename and the ID of the saved news item
                    $storagePath = $this->process_image($imageFilename, $saved_news->id);

                    if ($storagePath) { // Check if image processing was successful
                        $saved_news->images()->create([
                            'path' => $storagePath,
                        ]);
                    }
                }
            }
        });

        // Clean up the extracted images directory after all news items are processed
        File::deleteDirectory($this->dataPath("images"));
        // Optionally, delete the zip file itself if it's no longer needed
        // File::delete($this->dataPath("image.zip"));
    }
}