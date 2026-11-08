<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contracts\Repositories\GalleryRepository;
use App\Contracts\Repositories\NewsRepository;
use App\Services\DashboardService;

uses(RefreshDatabase::class);

test('admin returns stats shape', function () {
    $news = Mockery::mock(NewsRepository::class);
    $gallery = Mockery::mock(GalleryRepository::class);

    $news->shouldReceive('createdSince')->with(Mockery::type(\DateTimeInterface::class))->andReturn(2);
    $news->shouldReceive('createdBetween')->andReturn(1);
    $news->shouldReceive('count')->andReturn(5);
    $gallery->shouldReceive('createdSince')->andReturn(3);
    $gallery->shouldReceive('count')->andReturn(7);

    $service = new DashboardService($news, $gallery);
    $data = $service->admin();

    expect($data['totalNews'])->toBe(5);
    expect($data['totalGalleryItems'])->toBe(7);
    expect($data['gallerySubtext'])->toBe('+3 baru minggu ini');
});

test('home returns sliders and news', function () {
    $news = Mockery::mock(NewsRepository::class);
    $gallery = Mockery::mock(GalleryRepository::class);
    $news->shouldReceive('latest')->with(5)->andReturn(collect());

    $service = new DashboardService($news, $gallery);
    $data = $service->home();

    expect($data)->toHaveKeys(['sliders', 'news']);
});