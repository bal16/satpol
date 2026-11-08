<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface ImageStorage
{
    public function store(UploadedFile $file, string $directory): string;

    public function delete(?string $path): void;

    public function replace(UploadedFile $file, string $directory, ?string $oldPath): string;

    public function url(string $path): string;
}
