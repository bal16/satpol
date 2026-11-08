<?php

namespace App\Infrastructure\Storage;

use App\Contracts\ImageStorage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PublicImageStorage implements ImageStorage
{
    public function store(UploadedFile $file, string $directory): string
    {
        return $file->store($directory, 'public');
    }

    public function delete(?string $path): void
    {
        if (! $path) {
            return;
        }

        $disk = Storage::disk('public');

        if ($disk->exists($path)) {
            $disk->delete($path);
        }
    }

    public function replace(UploadedFile $file, string $directory, ?string $oldPath): string
    {
        $newPath = $this->store($file, $directory);

        $this->delete($oldPath);

        return $newPath;
    }

    public function url(string $path): string
    {
        return Storage::disk('public')->url($path);
    }
}
