<?php

namespace App\Services;

use App\Data\SopData;
use App\Models\SOP;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SopService
{
    public function list(): Collection
    {
        return SOP::all();
    }

    public function create(SopData $data): SOP
    {
        return DB::transaction(fn () => SOP::create($data->toArray()));
    }

    public function update(SOP $sop, SopData $data): SOP
    {
        return DB::transaction(function () use ($sop, $data) {
            $sop->update($data->toArray());

            return $sop;
        });
    }

    public function delete(SOP $sop): void
    {
        DB::transaction(fn () => $sop->delete());
    }
}
