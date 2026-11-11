<?php

use App\Models\ProfileItems;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->actingAs($this->admin);
    Storage::fake('public');
});

test('admin can update profile item text type', function () {
    $item = ProfileItems::factory()->create(['type' => 'text', 'content' => 'old']);

    $this->put(route('admin.profile.update', $item), [
        'title' => 'Judul',
        'type' => 'text',
        'show' => '1',
        'content_text' => 'konten baru',
    ])->assertRedirect(route('admin.profile'));

    $item->refresh();
    expect($item->title)->toBe('Judul');
    expect($item->content)->toBe('konten baru');
});

test('admin can update profile item to image', function () {
    $item = ProfileItems::factory()->create(['type' => 'text', 'content' => 'old']);

    $this->put(route('admin.profile.update', $item), [
        'title' => 'Judul',
        'type' => 'image',
        'show' => '1',
        'content_image' => UploadedFile::fake()->create('img.jpg', 10, 'image/jpeg'),
    ])->assertRedirect(route('admin.profile'));

    $item->refresh();
    expect($item->type)->toBe('image');
    expect(Storage::disk('public')->exists($item->content))->toBeTrue();
});

test('admin can update profile item html type', function () {
    $item = ProfileItems::factory()->create(['type' => 'text', 'content' => 'old']);

    $this->put(route('admin.profile.update', $item), [
        'title' => 'Judul',
        'type' => 'html',
        'show' => '1',
        'body' => '<p>html</p>',
    ])->assertRedirect(route('admin.profile'));

    $item->refresh();
    expect($item->type)->toBe('html');
});
