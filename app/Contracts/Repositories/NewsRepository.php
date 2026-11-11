<?php

namespace App\Contracts\Repositories;

use App\Models\News;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface NewsRepository
{
    public function paginate(?string $search, int $perPage): LengthAwarePaginator;

    public function latest(int $limit): Collection;

    public function findBySlug(string $slug): ?News;

    public function find(int $id): News;

    public function dataTableQuery(): Builder;

    public function create(array $attributes): News;

    public function update(News $news, array $attributes): News;

    public function delete(News $news): void;

    public function count(): int;

    public function createdSince(\DateTimeInterface $from): int;

    public function createdBetween(\DateTimeInterface $from, \DateTimeInterface $to): int;
}
