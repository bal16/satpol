<?php

use App\Models\Category;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->actingAs($this->admin);
});

test('admin can create update delete category', function () {
    $create = $this->post(route('admin.categories.store'), ['name' => 'Kategori Baru'], ['Accept' => 'application/json']);
    $create->assertStatus(201);

    $category = Category::first();
    expect($category->name)->toBe('Kategori Baru');

    $this->put(route('admin.categories.update', $category), ['name' => 'Kategori Edit'], ['Accept' => 'application/json'])
        ->assertOk();

    $category->refresh();
    expect($category->name)->toBe('Kategori Edit');

    $this->delete(route('admin.categories.destroy', $category), [], ['Accept' => 'application/json'])
        ->assertOk();

    expect(Category::find($category->id))->toBeNull();
});

test('category data endpoint returns json', function () {
    Category::factory()->count(2)->create();
    $this->get(route('admin.categories.data'), ['X-Requested-With' => 'XMLHttpRequest'])->assertOk();
});
