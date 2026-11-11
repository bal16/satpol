<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\GalleryRepository;
use App\Models\Gallery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class EloquentGalleryRepository implements GalleryRepository
{
    public function paginate(?int $categoryId, int $perPage): LengthAwarePaginator
    {
        return Gallery::query()
            ->when($categoryId, fn (Builder $query) => $query->where('category_id', $categoryId))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function dataTableQuery(): Builder
    {
        return Gallery::with('category')
            ->select(['id', 'title', 'path', 'category_id', 'created_at', 'updated_at'])
            ->latest();
    }

    public function create(array $attributes): Gallery
    {
        return Gallery::create($attributes);
    }

    public function update(Gallery $gallery, array $attributes): Gallery
    {
        $gallery->update($attributes);

        return $gallery;
    }

    public function delete(Gallery $gallery): void
    {
        $gallery->delete();
    }

    public function count(): int
    {
        return Gallery::count();
    }

    public function createdSince(\DateTimeInterface $from): int
    {
        return Gallery::where('created_at', '>=', $from)->count();
    }
}
