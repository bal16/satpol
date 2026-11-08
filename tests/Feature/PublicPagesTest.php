<?php

use App\Models\News;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

test('home page returns ok', function () {
    $this->get(route('home'))->assertOk();
});

test('news index and show return ok', function () {
    $news = News::factory()->create();

    $this->get(route('news'))->assertOk();
    $this->get(route('news.show', $news->slug))->assertOk();
});

test('services page returns ok', function () {
    Service::factory()->create();
    $this->get(route('services'))->assertOk();
});

test('gallery page returns ok', function () {
    $this->get(route('gallery'))->assertOk();
});

test('profile page returns ok', function () {
    $this->get(route('profile'))->assertOk();
});
