<?php

use App\Models\Category;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->actingAs($this->admin);
    Storage::fake('public');
});

test('admin gallery page returns ok', function () {
    $this->get(route('admin.gallery'))->assertOk();
});

test('admin can create gallery with new category', function () {
    $response = $this->post(route('admin.gallery.store'), [
        'title' => 'Foto Kegiatan',
        'photo' => UploadedFile::fake()->create('foto.jpg', 10, 'image/jpeg'),
        'new_category_name' => 'Kegiatan',
    ], ['Accept' => 'application/json']);

    $response->assertStatus(201);

    $gallery = Gallery::first();
    expect($gallery->title)->toBe('Foto Kegiatan');
    expect($gallery->category->name)->toBe('Kegiatan');
    expect(Storage::disk('public')->exists($gallery->path))->toBeTrue();
});

test('admin can update gallery photo and category', function () {
    $category = Category::factory()->create();
    $gallery = Gallery::factory()->create(['category_id' => $category->id]);
    Storage::disk('public')->put($gallery->path, 'x');

    $response = $this->post(route('admin.gallery.update', $gallery), [
        '_method' => 'PUT',
        'title' => 'Judul Baru',
        'photo' => UploadedFile::fake()->create('baru.jpg', 10, 'image/jpeg'),
        'category_id' => $category->id,
    ], ['Accept' => 'application/json']);

    $response->assertOk();
    $gallery->refresh();
    expect($gallery->title)->toBe('Judul Baru');
    expect(Storage::disk('public')->exists($gallery->path))->toBeTrue();
});

test('admin can delete gallery via ajax', function () {
    $gallery = Gallery::factory()->create();
    Storage::disk('public')->put($gallery->path, 'x');

    $this->delete(route('admin.gallery.destroy', $gallery), [], ['Accept' => 'application/json'])
        ->assertOk()
        ->assertJson(['message' => 'Galeri berhasil dihapus!']);

    expect(Gallery::find($gallery->id))->toBeNull();
    expect(Storage::disk('public')->exists($gallery->path))->toBeFalse();
});

test('gallery data endpoint returns json', function () {
    Gallery::factory()->count(3)->create();
    $this->get(route('gallery.data'), ['X-Requested-With' => 'XMLHttpRequest'])->assertOk();
});
