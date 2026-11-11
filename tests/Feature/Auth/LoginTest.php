<?php

use App\Models\User;
use App\Services\MathCaptchaService;

test('login page can be rendered with math captcha', function () {
    $response = $this->get(route('login'));

    $response->assertOk();
    $response->assertSee('Verifikasi Keamanan:');
    $response->assertSee('name="math_captcha"', false);
    $response->assertSee('name="website_url"', false);
});

test('user can authenticate using valid credentials and captcha', function () {
    $user = User::factory()->admin()->create([
        'username' => 'admin_test',
        'password' => bcrypt('secret123'),
    ]);

    session()->put(MathCaptchaService::SESSION_KEY, 10);

    $response = $this->post(route('login.store'), [
        'key' => 'admin_test',
        'password' => 'secret123',
        'math_captcha' => '10',
    ]);

    $this->assertAuthenticatedAs($user);
    $response->assertRedirect(route('admin.dashboard'));
});

test('login fails when math captcha is incorrect', function () {
    $user = User::factory()->admin()->create([
        'username' => 'admin_test',
        'password' => bcrypt('secret123'),
    ]);

    session()->put(MathCaptchaService::SESSION_KEY, 10);

    $response = $this->from(route('login'))->post(route('login.store'), [
        'key' => 'admin_test',
        'password' => 'secret123',
        'math_captcha' => '99',
    ]);

    $this->assertGuest();
    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors(['math_captcha']);
});

test('login fails when honeypot field is filled by bot', function () {
    User::factory()->admin()->create([
        'username' => 'admin_test',
        'password' => bcrypt('secret123'),
    ]);

    session()->put(MathCaptchaService::SESSION_KEY, 10);

    $response = $this->from(route('login'))->post(route('login.store'), [
        'key' => 'admin_test',
        'password' => 'secret123',
        'math_captcha' => '10',
        'website_url' => 'https://spam-bot.site',
    ]);

    $this->assertGuest();
    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors(['website_url']);
});

test('authenticated user can logout', function () {
    $user = User::factory()->admin()->create();

    $response = $this->actingAs($user)->delete(route('logout'));

    $this->assertGuest();
    $response->assertRedirect('/');
});
