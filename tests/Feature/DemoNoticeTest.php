<?php

use App\Models\News;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

test('public pages display demo announcement bar, modal, and footer disclaimer', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('id="demo-announcement-bar"', false);
    $response->assertSee('id="demo-onboarding-modal"', false);
    $response->assertSee('satpol_demo_notice_seen');
    $response->assertSee('satpol_demo_banner_dismissed');
    $response->assertSee('Portofolio Showcase');
    $response->assertSee('bukan situs resmi instansi pemerintah');
});

test('public news page also includes portfolio demo notices', function () {
    News::factory()->create();

    $response = $this->get(route('news'));

    $response->assertOk();
    $response->assertSee('id="demo-announcement-bar"', false);
    $response->assertSee('id="demo-onboarding-modal"', false);
    $response->assertSee('Portofolio Showcase');
});
