<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\NewsRepository;
use App\Models\News;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class EloquentNewsRepository implements NewsRepository
{
    public function paginate(?string $search, int $perPage): LengthAwarePaginator
    {
        $query = News::query()->latest();

        if ($search) {
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhereHas('richTextBody', function (Builder $builder) use ($search) {
                        $builder->where('body', 'like', "%{$search}%");
                    });
            });
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function latest(int $limit): Collection
    {
        return News::latest()->take($limit)->get();
    }

    public function findBySlug(string $slug): ?News
    {
        return News::where('slug', $slug)->first();
    }

    public function find(int $id): News
    {
        return News::findOrFail($id);
    }

    public function dataTableQuery(): Builder
    {
        return News::select(['id', 'title', 'slug', 'created_at', 'updated_at']);
    }

    public function create(array $attributes): News
    {
        return News::create($attributes);
    }

    public function update(News $news, array $attributes): News
    {
        $news->update($attributes);

        return $news;
    }

    public function delete(News $news): void
    {
        $news->delete();
    }

    public function count(): int
    {
        return News::count();
    }

    public function createdSince(\DateTimeInterface $from): int
    {
        return News::where('created_at', '>=', $from)->count();
    }

    public function createdBetween(\DateTimeInterface $from, \DateTimeInterface $to): int
    {
        return News::whereBetween('created_at', [$from, $to])->count();
    }
}
