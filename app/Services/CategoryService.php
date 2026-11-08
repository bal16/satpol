<?php

namespace App\Services;

use App\Data\CategoryData;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function list(?string $search = null): Collection
    {
        $query = Category::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        return $query->select('id', 'name')->get();
    }

    public function dataTableQuery(): Builder
    {
        return Category::latest()->select(['id', 'name', 'created_at', 'updated_at']);
    }

    public function create(CategoryData $data): Category
    {
        return DB::transaction(fn () => Category::create($data->toArray()));
    }

    public function update(Category $category, CategoryData $data): Category
    {
        return DB::transaction(function () use ($category, $data) {
            $category->update($data->toArray());

            return $category;
        });
    }

    public function delete(Category $category): void
    {
        DB::transaction(fn () => $category->delete());
    }

    public function findOrCreateByName(string $name): Category
    {
        return Category::firstOrCreate(['name' => $name]);
    }
}
