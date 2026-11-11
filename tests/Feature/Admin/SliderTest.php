<?php

use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->actingAs($this->admin);
    Storage::fake('public');
});

test('admin can update slider slot', function () {
    $this->patch(route('admin.sliders.update', ['slot_number' => 1]), [
        'slider_image' => UploadedFile::fake()->create('slider.jpg', 10, 'image/jpeg'),
    ])->assertRedirect();

    $slider = Slider::where('slot_number', 1)->first();
    expect($slider)->not->toBeNull();
    expect(Storage::disk('public')->exists($slider->image_path))->toBeTrue();
});
