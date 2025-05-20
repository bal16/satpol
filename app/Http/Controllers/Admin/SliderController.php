<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.slider', ['slider' => Slider::all(),]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        Slider::create([
            'Path' => $request->path
        ]);

        return redirect(route('admin.slider'));
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Slider $slider)
    // {
    //     return response()->json(['slider' => $slider]);
    // }

    /**
     * Show the form for editing the specified resource.
     */

    //  public function edit(Slider $slider)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        Slider::where($request->id)->update([
            'Path' => $slider->path
        ]);

        return redirect(route('admin.slider'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        Slider::destroy($slider->id);

        return redirect(route('admin.slider'));
    }
}
