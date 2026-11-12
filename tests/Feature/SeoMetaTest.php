<?php

use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

test('public pages have noindex nofollow and canonical meta tags', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('<meta name="robots" content="noindex, nofollow">', false);
    $response->assertSee('<link rel="canonical"', false);
    $response->assertSee('<meta name="description"', false);
});

test('public pages render open graph and twitter card meta tags', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('<meta property="og:type" content="website">', false);
    $response->assertSee('<meta property="og:title"', false);
    $response->assertSee('<meta property="og:description"', false);
    $response->assertSee('<meta property="og:image"', false);
    $response->assertSee('<meta name="twitter:card" content="summary_large_image">', false);
    $response->assertSee('<meta name="twitter:title"', false);
});

test('news detail page renders article specific og meta tags', function () {
    $news = News::factory()->create([
        'title' => 'Pengamanan Operasi Khusus',
    ]);

    NewsImage::factory()->create([
        'news_id' => $news->id,
        'path' => 'news/photo.jpg',
    ]);

    $response = $this->get(route('news.show', $news->slug));

    $response->assertOk();
    $response->assertSee('<meta property="og:type" content="article">', false);
    $response->assertSee('Pengamanan Operasi Khusus');
    $response->assertSee('news/photo.jpg');
});

test('robots txt disallows all robots', function () {
    $content = file_get_contents(public_path('robots.txt'));

    expect($content)->toContain('User-agent: *');
    expect($content)->toContain('Disallow: /');
});
