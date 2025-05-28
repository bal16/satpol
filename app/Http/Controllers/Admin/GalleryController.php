<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.gallery');
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
    public function store(StoreGalleryRequest $request)
    {
        Gallery::create([
            'title' => $request->title,
            'path' => $request->path,
            'category' => $request->category,
        ]);

        // return redirect(route('admin.gallery'));
        return response()->json([
            'message' => 'Gallery created successfully',
            'status' => true
        ]);
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Gallery $gallery)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Gallery $gallery)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $gallery->update([
            'title' => $request->title,
            'path' => $request->path,
            'category' => $request->category
        ]);

        // return redirect(route('admin.gallery'));
        return response()->json([
            'message' => 'Gallery updated successfully',
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        Gallery::destroy($gallery->id);

        return redirect(route('admin.gallery'));
        // return response()->json([
        //     'message' => 'Gallery deleted successfully',
        //     'status' => true
        // ]);
    }
}
