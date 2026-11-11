<?php

use App\Infrastructure\Storage\PublicImageStorage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Config::set('filesystems.media_disk', 's3');
    Storage::fake('s3');
});

test('PublicImageStorage store uploads file to configured s3 disk', function () {
    $storage = new PublicImageStorage;
    $file = UploadedFile::fake()->create('banner.jpg', 10, 'image/jpeg');

    $path = $storage->store($file, 'sliders');

    expect($path)->toBeString();
    Storage::disk('s3')->assertExists($path);
});

test('PublicImageStorage delete removes file from s3 disk', function () {
    $storage = new PublicImageStorage;
    $file = UploadedFile::fake()->create('test.png', 10, 'image/png');
    $path = $storage->store($file, 'gallery');

    Storage::disk('s3')->assertExists($path);

    $storage->delete($path);
    Storage::disk('s3')->assertMissing($path);
});

test('PublicImageStorage replace uploads new file and deletes old file on s3', function () {
    $storage = new PublicImageStorage;
    $oldFile = UploadedFile::fake()->create('old.jpg', 10, 'image/jpeg');
    $newFile = UploadedFile::fake()->create('new.jpg', 10, 'image/jpeg');

    $oldPath = $storage->store($oldFile, 'news');
    Storage::disk('s3')->assertExists($oldPath);

    $newPath = $storage->replace($newFile, 'news', $oldPath);

    Storage::disk('s3')->assertMissing($oldPath);
    Storage::disk('s3')->assertExists($newPath);
});

test('media_url returns s3 disk url when media_disk is s3', function () {
    $url = media_url('news/sample.jpg');

    expect($url)->toContain('news/sample.jpg');
});
