<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contracts\ImageStorage;
use App\Models\Slider;
use App\Services\SliderService;
use Illuminate\Http\UploadedFile;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->images = Mockery::mock(ImageStorage::class);
    $this->service = new SliderService($this->images);
});

test('updateSlot stores image and creates record', function () {
    $file = UploadedFile::fake()->create('s.jpg', 10, 'image/jpeg');
    $this->images->shouldReceive('store')->once()->with($file, 'sliders_images')->andReturn('sliders_images/s.jpg');
    $this->images->shouldReceive('delete')->once()->with(null);

    $slider = $this->service->updateSlot(1, $file);
    expect($slider)->toBeInstanceOf(Slider::class);
    expect($slider->image_path)->toBe('sliders_images/s.jpg');
});

test('listBySlot returns keyed collection', function () {
    Slider::create(['slot_number' => 1, 'image_path' => 'x.jpg']);
    $result = $this->service->listBySlot();
    expect($result)->toHaveKey(1);
});