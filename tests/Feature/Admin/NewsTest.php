<?php

use App\Models\News;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->actingAs($this->admin);
    Storage::fake('public');
});

test('admin news index returns ok', function () {
    $this->get(route('admin.news'))->assertOk();
});

test('admin can create news with images', function () {
    $response = $this->post(route('admin.news.store'), [
        'title' => 'Judul Berita',
        'author' => 'Penulis',
        'slug' => 'judul-berita',
        'body' => '<p>isi</p>',
        'images' => [UploadedFile::fake()->create('a.jpg', 10, 'image/jpeg')],
    ]);

    $response->assertRedirect(route('admin.news'));

    $news = News::first();
    expect($news)->not->toBeNull();
    expect($news->title)->toBe('Judul Berita');
    expect($news->author)->toBe('Penulis');
    expect($news->images)->toHaveCount(1);
    expect(Storage::disk('public')->exists($news->images->first()->path))->toBeTrue();
});

test('admin can update news', function () {
    $news = News::factory()->create();

    $this->put(route('admin.news.update', $news), [
        'title' => 'Judul Baru',
        'author' => 'Penulis Baru',
        'slug' => 'judul-baru',
        'body' => '<p>baru</p>',
    ])->assertRedirect(route('admin.news'));

    $news->refresh();
    expect($news->title)->toBe('Judul Baru');
    expect($news->author)->toBe('Penulis Baru');
    expect($news->slug)->toBe('judul-baru');
});

test('admin can delete news and its images', function () {
    $news = News::factory()->create();
    $image = $news->images()->create(['path' => 'news_images/'.$news->id.'/x.jpg']);
    Storage::disk('public')->put($image->path, 'x');

    $this->delete(route('admin.news.destroy', $news))->assertRedirect(route('admin.news'));

    expect(News::find($news->id))->toBeNull();
    expect(Storage::disk('public')->exists($image->path))->toBeFalse();
});

test('news store validates required fields', function () {
    $this->post(route('admin.news.store'), [])->assertSessionHasErrors(['title', 'author', 'slug', 'images']);
});
