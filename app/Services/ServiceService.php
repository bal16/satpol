<?php

namespace App\Services;

use App\Contracts\ImageStorage;
use App\Contracts\Repositories\ServiceRepository;
use App\Data\ServiceData;
use App\Data\ServiceItemData;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServiceService
{
    public function __construct(
        private ServiceRepository $repository,
        private ImageStorage $images,
    ) {}

    public function listWithItems(): Collection
    {
        return $this->repository->allWithItems();
    }

    public function find(int $id): Service
    {
        return $this->repository->find($id);
    }

    public function dataTableQuery(): Builder
    {
        return $this->repository->dataTableQuery();
    }

    public function itemsDataTableQuery(Service $service): Builder
    {
        return $this->repository->itemsDataTableQuery($service);
    }

    public function create(ServiceData $data, UploadedFile $photo): Service
    {
        return DB::transaction(function () use ($data, $photo) {
            $path = $this->images->store($photo, 'services_images');

            try {
                return $this->repository->create(array_merge($data->toArray(), ['image_src' => $path]));
            } catch (\Throwable $exception) {
                $this->images->delete($path);

                throw $exception;
            }
        });
    }

    public function update(Service $service, ServiceData $data, ?UploadedFile $photo = null): Service
    {
        return DB::transaction(function () use ($service, $data, $photo) {
            $attributes = $data->toArray();

            if ($photo) {
                $attributes['image_src'] = $this->images->replace($photo, 'services_images', $service->image_src);
            }

            return $this->repository->update($service, $attributes);
        });
    }

    public function delete(Service $service): void
    {
        DB::transaction(function () use ($service) {
            $this->images->delete($service->image_src);
            $this->repository->delete($service);
        });
    }

    public function createItem(Service $service, ServiceItemData $data): ServiceItem
    {
        return $service->items()->create($data->toArray());
    }

    public function updateItem(ServiceItem $item, ServiceItemData $data): ServiceItem
    {
        $item->update($data->toArray());

        return $item;
    }

    public function deleteItem(ServiceItem $item): void
    {
        $item->delete();
    }
}
