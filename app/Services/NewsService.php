<?php

namespace App\Services;

use App\Contracts\ImageStorage;
use App\Contracts\Repositories\NewsRepository;
use App\Contracts\RichTextRenderer;
use App\Data\NewsData;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class NewsService
{
    public function __construct(
        private NewsRepository $repository,
        private ImageStorage $images,
        private RichTextRenderer $richText,
    ) {}

    public function paginate(?string $search, int $perPage = 5): LengthAwarePaginator
    {
        return $this->repository->paginate($search, $perPage);
    }

    public function latest(int $limit = 5): Collection
    {
        return $this->repository->latest($limit);
    }

    public function findBySlug(string $slug): News
    {
        $news = $this->repository->findBySlug($slug);

        if (! $news) {
            abort(404);
        }

        return $news;
    }

    public function find(int $id): News
    {
        return $this->repository->find($id);
    }

    public function dataTableQuery(): Builder
    {
        return $this->repository->dataTableQuery();
    }

    public function create(NewsData $data, array $uploadedImages = []): News
    {
        return DB::transaction(function () use ($data, $uploadedImages) {
            $news = $this->repository->create($data->toArray());

            $stored = [];

            try {
                foreach ($uploadedImages as $file) {
                    $path = $this->images->store($file, 'news_images/'.$news->id);
                    $stored[] = $path;
                    $news->images()->create(['path' => $path]);
                }
            } catch (\Throwable $exception) {
                foreach ($stored as $path) {
                    $this->images->delete($path);
                }

                throw $exception;
            }

            return $news;
        });
    }

    public function update(News $news, NewsData $data): News
    {
        return $this->repository->update($news, $data->toArray());
    }

    public function delete(News $news): void
    {
        DB::transaction(function () use ($news) {
            foreach ($news->images as $image) {
                $this->images->delete($image->path);
            }

            $this->repository->delete($news);
        });
    }

    public function addImages(News $news, array $uploadedImages): void
    {
        DB::transaction(function () use ($news, $uploadedImages) {
            $stored = [];

            try {
                foreach ($uploadedImages as $file) {
                    $path = $this->images->store($file, 'news_images/'.$news->id);
                    $stored[] = $path;
                    $news->images()->create(['path' => $path]);
                }
            } catch (\Throwable $exception) {
                foreach ($stored as $path) {
                    $this->images->delete($path);
                }

                throw $exception;
            }
        });
    }

    public function deleteImage(NewsImage $image): void
    {
        $this->images->delete($image->path);
        $image->delete();
    }

    public function toTrixHtml(mixed $richText): string
    {
        return $this->richText->toTrixHtml($richText);
    }

    public function stats(): array
    {
        $newsThisMonth = $this->repository->createdSince(now()->startOfMonth());
        $newsLastMonth = $this->repository->createdBetween(
            now()->subMonth()->startOfMonth(),
            now()->subMonth()->endOfMonth()
        );

        if ($newsLastMonth > 0) {
            $change = (($newsThisMonth - $newsLastMonth) / $newsLastMonth) * 100;
            $subtext = sprintf('%s%.0f%% dari bulan lalu', $change >= 0 ? '+' : '', $change);
        } else {
            $subtext = $newsThisMonth > 0 ? "{$newsThisMonth} berita baru bulan ini" : 'Tidak ada berita baru';
        }

        return [
            'total' => $this->repository->count(),
            'subtext' => $subtext,
        ];
    }
}
