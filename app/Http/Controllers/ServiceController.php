<?php

namespace App\Http\Controllers;

use App\Models\Service;
// use App\Http\Requests\StoreServiceRequest;
// use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('services', ['services' => Service::all()]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('service.show', ['service' => $service]);
    }
}
