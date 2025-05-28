<?php
namespace App\Http\Controllers;

use App\Models\Slider;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Slider::all());
        return view('dashboard', [
            'sliders' => Slider::all()
        ]);
    }
}
