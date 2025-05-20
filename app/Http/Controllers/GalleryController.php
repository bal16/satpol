<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
// use App\Http\Requests\StoreGalleryRequest;
// use App\Http\Requests\UpdateGalleryRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('gallery', ['gallery' => Gallery::all(),]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('gallery.show',['gallery' => $gallery]);
    }
}
