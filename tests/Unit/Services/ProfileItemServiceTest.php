<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contracts\ImageStorage;
use App\Data\ProfileItemData;
use App\Models\ProfileItems;
use App\Services\ProfileItemService;
use Illuminate\Http\UploadedFile;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->images = Mockery::mock(ImageStorage::class);
    $this->service = new ProfileItemService($this->images);
});

test('update text type sets content', function () {
    $item = ProfileItems::create(['title' => 'T', 'type' => 'text', 'content' => 'old', 'show' => false]);

    $data = new ProfileItemData('T', 'text', true, 'new content', null);
    $result = $this->service->update($item, $data);

    expect($result->content)->toBe('new content');
    expect($result->type)->toBe('text');
});

test('update image type stores file', function () {
    $item = ProfileItems::create(['title' => 'T', 'type' => 'text', 'content' => 'old', 'show' => false]);

    $file = UploadedFile::fake()->create('i.jpg', 10, 'image/jpeg');
    $this->images->shouldReceive('delete')->with('old')->andReturn(null);
    $this->images->shouldReceive('store')->once()->with($file, 'profile_images')->andReturn('profile_images/i.jpg');

    $data = new ProfileItemData('T', 'image', true, null, null);
    $result = $this->service->update($item, $data, $file);

    expect($result->type)->toBe('image');
    expect($result->content)->toBe('profile_images/i.jpg');
});

test('list returns collection', function () {
    expect($this->service->list())->toBeInstanceOf(\Illuminate\Support\Collection::class);
});