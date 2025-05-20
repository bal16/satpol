<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.service');
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        Service::create([
            'title' => $request->title,
            'url' => $request->url,
            'category' => $request->category,
        ]);

        return redirect(route('admin.service'));
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Service $service)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Service $service)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        Service::where($request->id)->update([
            'title' => $service->title,
            'url' => $service->url,
            'category' => $service->category
        ]);

        return redirect(route('admin.service'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        Service::destroy($service->id);

        return redirect(route('admin.service'));
    }
}
