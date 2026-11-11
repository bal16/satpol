<?php

namespace App\Services;

use App\Contracts\ImageStorage;
use Illuminate\Http\UploadedFile;

class AttachmentService
{
    public function __construct(private ImageStorage $images) {}

    public function store(UploadedFile $file): string
    {
        $path = $this->images->store($file, 'attachments');

        return $this->images->url($path);
    }
}
