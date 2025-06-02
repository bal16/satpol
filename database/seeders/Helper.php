<?php


namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



trait Helper
{
    private function process_image($imageFilename, $id = "", $for = "news")
    {
        $sourceImagePath = $this->dataPath("images/" . $for . "/" . $imageFilename);
        if (!File::exists($sourceImagePath)) {
            // Optionally, log this error or handle it if an image is missing
            // For now, we'll return null if the source image doesn't exist
            if (isset($this->command)) {
                $this->command->error("Source image not found: {$sourceImagePath}");
            }
            return null;
        }
        $imageContent = file_get_contents($sourceImagePath);
        $extension = pathinfo($sourceImagePath, PATHINFO_EXTENSION);

        $randomString = Str::random(40);
        if ($id !== "") {
            $storagePath = $for . '_images/' . $id . '/' . $randomString . '.' . $extension;
        } else {
            $storagePath = $for . '_images/' . $randomString . '.' . $extension;
        }
        Storage::disk('public')->put($storagePath, $imageContent);

        return $storagePath;
    }

    private function unzip($path, $target = "news")
    {
        if (!extension_loaded('zip')) {
            $this->command->error('The PHP Zip extension is not enabled. Please enable it to proceed.');
            return;
        }

        $zipFilePath = $this->dataPath($path);

        if (!File::exists($zipFilePath)) { // Explicitly use File facade
            $this->command->error("Zip file not found at: {$zipFilePath}");
            return;
        }

        if (!File::isReadable($zipFilePath)) { // Explicitly use File facade
            $this->command->error("Zip file is not readable at: {$zipFilePath}. Check permissions.");
            return;
        }

        $zip = new \ZipArchive;
        $res = $zip->open($zipFilePath);

        if ($res === TRUE) {
            $extractPath = $this->dataPath("images/" . $target);

            // Ensure the extraction directory exists, create if not
            if (!File::isDirectory($extractPath)) { // Explicitly use File facade
                File::makeDirectory($extractPath, 0755, true, true); // Explicitly use File facade
            }

            // Clean the directory before extraction
            if (File::isDirectory($extractPath)) { // Explicitly use File facade
                File::cleanDirectory($extractPath); // Explicitly use File facade
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