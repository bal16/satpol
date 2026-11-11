<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Data\SopData;
use App\Models\SOP;
use App\Services\SopService;

uses(RefreshDatabase::class);

test('sop service crud', function () {
    $service = new SopService();

    $created = $service->create(new SopData('T', 'https://example.com'));
    expect($created)->toBeInstanceOf(SOP::class);

    $updated = $service->update($created, new SopData('T2', 'https://example.com/2'));
    expect($updated->title)->toBe('T2');

    $service->delete($updated);
    expect(SOP::find($updated->id))->toBeNull();
});

test('list returns collection', function () {
    $service = new SopService();
    expect($service->list())->toBeInstanceOf(\Illuminate\Support\Collection::class);
});