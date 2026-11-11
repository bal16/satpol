<?php

namespace App\Infrastructure\Storage;

use App\Contracts\ImageStorage;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PublicImageStorage implements ImageStorage
{
    protected function diskName(): string
    {
        return config('filesystems.media_disk', 'public');
    }

    protected function disk(): Filesystem
    {
        return Storage::disk($this->diskName());
    }

    public function store(UploadedFile $file, string $directory): string
    {
        return $file->store($directory, $this->diskName());
    }

    public function delete(?string $path): void
    {
        if (! $path) {
            return;
        }

        $disk = $this->disk();

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
        return $this->disk()->url($path);
    }
}
