<?php

namespace App\Contracts\Repositories;

use App\Models\Gallery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

interface GalleryRepository
{
    public function paginate(?int $categoryId, int $perPage): LengthAwarePaginator;

    public function dataTableQuery(): Builder;

    public function create(array $attributes): Gallery;

    public function update(Gallery $gallery, array $attributes): Gallery;

    public function delete(Gallery $gallery): void;

    public function count(): int;

    public function createdSince(\DateTimeInterface $from): int;
}
