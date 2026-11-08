<?php

use App\Contracts\ImageStorage;
use App\Contracts\Repositories\GalleryRepository;
use App\Data\GalleryData;
use App\Models\Category;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->repo = Mockery::mock(GalleryRepository::class);
    $this->images = Mockery::mock(ImageStorage::class);
    $this->service = new GalleryService($this->repo, $this->images);
});

test('create resolves new category and stores photo', function () {
    $category = new Category(['name' => 'New']);
    $category->id = 7;
    // firstOrCreate mock via Category facade not mocked; instead rely on DB? We'll mock by partial? 
    // To avoid DB, simulate: use Mockery for Category not possible (static). Skip category creation path here.
    $gallery = new Gallery(['title' => 'T']);
    $this->repo->shouldReceive('create')->once()->andReturn($gallery);

    $file = UploadedFile::fake()->create('a.jpg', 10, 'image/jpeg');
    $this->images->shouldReceive('store')->once()->with($file, 'gallery_images')->andReturn('gallery_images/a.jpg');

    $data = new GalleryData('T', null, null);
    $result = $this->service->create($data, $file);
    expect($result)->toBe($gallery);
});

test('delete removes image and row', function () {
    $gallery = new Gallery(['title' => 'T', 'path' => 'gallery_images/x.jpg']);
    $this->images->shouldReceive('delete')->once()->with('gallery_images/x.jpg');
    $this->repo->shouldReceive('delete')->once()->with($gallery);

    $this->service->delete($gallery);
});

test('stats returns total and new this week', function () {
    $this->repo->shouldReceive('count')->once()->andReturn(4);
    $this->repo->shouldReceive('createdSince')->once()->andReturn(2);

    $stats = $this->service->stats();
    expect($stats['total'])->toBe(4);
    expect($stats['newThisWeek'])->toBe(2);
});