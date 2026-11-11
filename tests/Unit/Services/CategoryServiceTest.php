<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Data\CategoryData;
use App\Models\Category;
use App\Services\CategoryService;

uses(RefreshDatabase::class);

test('create and update and delete', function () {
    $service = new CategoryService();

    $created = $service->create(new CategoryData('Nama'));
    expect($created)->toBeInstanceOf(Category::class);

    $updated = $service->update($created, new CategoryData('Baru'));
    expect($updated->name)->toBe('Baru');

    $service->delete($updated);
    expect(Category::find($updated->id))->toBeNull();
});