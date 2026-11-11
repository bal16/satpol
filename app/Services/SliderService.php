<?php

namespace App\Services;

use App\Contracts\ImageStorage;
use App\Models\Slider;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SliderService
{
    public function __construct(private ImageStorage $images) {}

    public function listBySlot(): Collection
    {
        return Slider::orderBy('slot_number')->get()->keyBy('slot_number');
    }

    public function updateSlot(int $slotNumber, UploadedFile $file): Slider
    {
        return DB::transaction(function () use ($slotNumber, $file) {
            $path = $this->images->store($file, 'sliders_images');

            $slider = Slider::where('slot_number', $slotNumber)->first();
            $oldPath = $slider?->image_path;

            try {
                $record = Slider::updateOrCreate(
                    ['slot_number' => $slotNumber],
                    ['image_path' => $path]
                );
            } catch (\Throwable $exception) {
                $this->images->delete($path);

                throw $exception;
            }

            $this->images->delete($oldPath);

            return $record;
        });
    }
}
