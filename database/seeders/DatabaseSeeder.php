<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; // Added for directory operations

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

        $this->unzip("image.zip");
        $this->makeCollectionfromJSON($this->dataPath("news.json"))->each(function ($news) {
            $saved_news = News::create([
                'title' => $news->title,
                'body' => $news->body,
                'slug' => $news->slug,
            ]);

            $images = $news->image;

            foreach ($images as $image) {

                $hashedFileName = $this->process_image($image);

                $saved_news->images()->create([
                    'path' => $hashedFileName,
                ]);
            }

            // File::delete($this->dataPath("image.zip"));
        });

        File::deleteDirectory($this->dataPath("images"));
    }


    private function process_image($image)
    {
        $imageContent = file_get_contents($this->dataPath("images/" . $image));
        $extension = pathinfo($this->dataPath("images/" . $image), PATHINFO_EXTENSION);

        $randomString = Str::random(40);
        $hashedFileName = "news_image/$randomString.$extension";
        Storage::put($hashedFileName, $imageContent);

        if (file_exists($this->dataPath("images/" . $image))) {
            unlink($this->dataPath("images/" . $image));
        }
        return $hashedFileName;
    }

    private function unzip($path)
    {
        if (!extension_loaded('zip')) {
            $this->command->error('The PHP Zip extension is not enabled. Please enable it to proceed.');
            return;
        }

        $zipFilePath = $this->dataPath($path);

        if (!File::exists($zipFilePath)) {
            $this->command->error("Zip file not found at: {$zipFilePath}");
            return;
        }

        if (!File::isReadable($zipFilePath)) {
            $this->command->error("Zip file is not readable at: {$zipFilePath}. Check permissions.");
            return;
        }

        $zip = new \ZipArchive;
        $res = $zip->open($zipFilePath);

        if ($res === TRUE) {
            $extractPath = $this->dataPath("images");

            // Ensure the extraction directory exists, create if not
            if (!File::isDirectory($extractPath)) {
                File::makeDirectory($extractPath, 0755, true, true);
            }

            // Clean the directory before extraction
            if (File::isDirectory($extractPath)) {
                File::cleanDirectory($extractPath);
            } else {
                $this->command->error("Failed to create or access extraction directory: {$extractPath}");
                $zip->close();
                return;
            }

            $zip->extractTo($extractPath);
            $zip->close();
            $this->command->info("Successfully unzipped '{$path}' to '{$extractPath}'.");
        } else {
            $this->command->error("Failed to open zip file '{$path}'. ZipArchive Error Code: " . $this->getZipErrorMessage($res));
            return;
        }
    }

    private function dataPath($path = '')
    {
        return rtrim(base_path("database/seeders/data"), '/') . '/' . ltrim($path, '/');
    }

    private function makeCollectionfromJSON($path)
    {
        return collect(
            json_decode(
                file_get_contents($path)
            ) // Assuming $path here is already the full path from dataPath or similar
        );
    }

    private function getZipErrorMessage($errorCode)
    {
        switch ($errorCode) {
            case \ZipArchive::ER_EXISTS:
                return 'File already exists.';
            case \ZipArchive::ER_INCONS:
                return 'Zip archive inconsistent.';
            case \ZipArchive::ER_INVAL:
                return 'Invalid argument.';
            case \ZipArchive::ER_MEMORY:
                return 'Malloc failure.';
            case \ZipArchive::ER_NOENT:
                return 'No such file.';
            case \ZipArchive::ER_NOZIP:
                return 'Not a zip archive.';
            case \ZipArchive::ER_OPEN:
                return 'Can\'t open file.';
            case \ZipArchive::ER_READ:
                return 'Read error.';
            case \ZipArchive::ER_SEEK:
                return 'Seek error.';
            default:
                return 'Unknown error (' . $errorCode . ')';
        }
    }
}