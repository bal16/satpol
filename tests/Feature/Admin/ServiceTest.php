<?php

use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->actingAs($this->admin);
    Storage::fake('public');
});

test('admin services page returns ok', function () {
    $this->get(route('admin.services'))->assertOk();
});

test('admin can create service with image', function () {
    $response = $this->post(route('admin.services.store'), [
        'title' => 'Layanan A',
        'image_src' => UploadedFile::fake()->create('svc.jpg', 10, 'image/jpeg'),
        'card_id' => 'card-1',
    ]);

    $response->assertRedirect(route('admin.services'));

    $service = Service::first();
    expect($service->title)->toBe('Layanan A');
    expect(Storage::disk('public')->exists($service->image_src))->toBeTrue();
});

test('admin can update service image', function () {
    $service = Service::factory()->create();
    Storage::disk('public')->put($service->image_src, 'x');

    $this->put(route('admin.services.update', $service), [
        'title' => 'Layanan B',
        'image_src' => UploadedFile::fake()->create('svc2.jpg', 10, 'image/jpeg'),
        'card_id' => 'card-2',
    ])->assertRedirect(route('admin.services'));

    $service->refresh();
    expect($service->title)->toBe('Layanan B');
    expect(Storage::disk('public')->exists($service->image_src))->toBeTrue();
});

test('admin can delete service via ajax', function () {
    $service = Service::factory()->create();
    Storage::disk('public')->put($service->image_src, 'x');

    $this->delete(route('admin.services.destroy', $service), [], ['X-Requested-With' => 'XMLHttpRequest'])
        ->assertOk()
        ->assertJson(['message' => 'Kartu Informasi berhasil dihapus.']);

    expect(Service::find($service->id))->toBeNull();
});

test('admin can manage service items', function () {
    $service = Service::factory()->create();

    $this->post(route('admin.services.items.store', $service), [
        'text' => 'Item 1',
        'href' => 'https://example.com',
    ])->assertStatus(201);

    $item = ServiceItem::first();
    expect($item->text)->toBe('Item 1');

    $this->put(route('admin.services.items.update', $item), [
        'text' => 'Item 1 updated',
        'href' => 'https://example.com/x',
    ])->assertStatus(200);

    $item->refresh();
    expect($item->text)->toBe('Item 1 updated');

    $this->delete(route('admin.services.items.destroy', $item))->assertOk();
    expect(ServiceItem::find($item->id))->toBeNull();
});
