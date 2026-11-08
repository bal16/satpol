<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSliderRequest;
use App\Services\SliderService;

class SliderController extends Controller
{
    public function __construct(private SliderService $service) {}

    public function index()
    {
        $sliders = $this->service->listBySlot();

        return view('admin.slider', [
            'currentSlidersData' => $sliders,
        ]);
    }

    public function update(UpdateSliderRequest $request, $slot_number)
    {
        $this->service->updateSlot((int) $slot_number, $request->file('slider_image'));

        return redirect()->route('admin.sliders')
            ->with('success_slot_'.$slot_number, 'Gambar untuk Slider #'.$slot_number.' berhasil diperbarui.');
    }
}
