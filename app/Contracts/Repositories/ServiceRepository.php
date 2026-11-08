<?php

namespace App\Contracts\Repositories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface ServiceRepository
{
    public function allWithItems(): Collection;

    public function find(int $id): Service;

    public function dataTableQuery(): Builder;

    public function itemsDataTableQuery(Service $service): Builder;

    public function create(array $attributes): Service;

    public function update(Service $service, array $attributes): Service;

    public function delete(Service $service): void;
}
