<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\ServiceRepository;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class EloquentServiceRepository implements ServiceRepository
{
    public function allWithItems(): Collection
    {
        return Service::with('items')->get();
    }

    public function find(int $id): Service
    {
        return Service::with('items')->findOrFail($id);
    }

    public function dataTableQuery(): Builder
    {
        return Service::latest();
    }

    public function itemsDataTableQuery(Service $service): Builder
    {
        return $service->items()->latest();
    }

    public function create(array $attributes): Service
    {
        return Service::create($attributes);
    }

    public function update(Service $service, array $attributes): Service
    {
        $service->update($attributes);

        return $service;
    }

    public function delete(Service $service): void
    {
        $service->delete();
    }
}
