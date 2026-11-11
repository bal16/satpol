<?php

namespace App\Services;

use App\Contracts\ImageStorage;
use App\Contracts\Repositories\GalleryRepository;
use App\Data\GalleryData;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GalleryService
{
    public function __construct(
        private GalleryRepository $repository,
        private ImageStorage $images,
    ) {}

    public function paginate(?int $categoryId, int $perPage = 12): LengthAwarePaginator
    {
        return $this->repository->paginate($categoryId, $perPage);
    }

    public function dataTableQuery(): Builder
    {
        return $this->repository->dataTableQuery();
    }

    public function categoriesWithGalleries(): Collection
    {
        return Category::whereHas('galleries')->orderBy('name')->get();
    }

    public function create(GalleryData $data, ?UploadedFile $photo = null): Gallery
    {
        return DB::transaction(function () use ($data, $photo) {
            $categoryId = $data->categoryId;

            if (! $categoryId && $data->newCategoryName) {
                $categoryId = Category::firstOrCreate(['name' => $data->newCategoryName])->id;
            }

            $path = null;

            if ($photo) {
                $path = $this->images->store($photo, 'gallery_images');
            }

            try {
                return $this->repository->create([
                    'title' => $data->title,
                    'path' => $path,
                    'category_id' => $categoryId,
                ]);
            } catch (\Throwable $exception) {
                $this->images->delete($path);

                throw $exception;
            }
        });
    }

    public function update(Gallery $gallery, GalleryData $data, ?UploadedFile $photo = null): Gallery
    {
        return DB::transaction(function () use ($gallery, $data, $photo) {
            $categoryId = $data->categoryId;

            if (! $categoryId && $data->newCategoryName) {
                $categoryId = Category::firstOrCreate(['name' => $data->newCategoryName])->id;
            }

            if ($data->categoryId === null && ! $data->newCategoryName) {
                $categoryId = null;
            }

            $attributes = [
                'title' => $data->title,
                'category_id' => $categoryId,
            ];

            if ($photo) {
                $attributes['path'] = $this->images->replace($photo, 'gallery_images', $gallery->path);
            }

            return $this->repository->update($gallery, $attributes);
        });
    }

    public function delete(Gallery $gallery): void
    {
        DB::transaction(function () use ($gallery) {
            $this->images->delete($gallery->path);
            $this->repository->delete($gallery);
        });
    }

    public function stats(): array
    {
        return [
            'total' => $this->repository->count(),
            'newThisWeek' => $this->repository->createdSince(now()->startOfWeek()),
        ];
    }
}
