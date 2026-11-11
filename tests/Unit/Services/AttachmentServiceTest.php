<?php

use App\Contracts\ImageStorage;
use App\Services\AttachmentService;
use Illuminate\Http\UploadedFile;

test('store returns url', function () {
    $images = Mockery::mock(ImageStorage::class);
    $file = UploadedFile::fake()->create('doc.pdf', 10, 'application/pdf');

    $images->shouldReceive('store')->once()->with($file, 'attachments')->andReturn('attachments/doc.pdf');
    $images->shouldReceive('url')->once()->with('attachments/doc.pdf')->andReturn('http://localhost/storage/attachments/doc.pdf');

    $service = new AttachmentService($images);
    expect($service->store($file))->toBe('http://localhost/storage/attachments/doc.pdf');
});