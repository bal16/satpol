<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
// use App\Http\Requests\StoreSliderRequest;
use App\Http\Controllers\Controller;
// use App\Http\Requests\UpdateSliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json( ['slider' => Slider::all(),]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return response()->json(['slider' => $slider]);
    }
}
