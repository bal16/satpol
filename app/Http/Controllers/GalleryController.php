<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
// use App\Http\Requests\StoreGalleryRequest;
// use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Gallery::select('category')->distinct()->pluck('category');
        $selectedCategory = $request->input('category');

        $query = Gallery::query();

        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }

        $data = $query->orderBy('created_at', 'desc')->paginate(12);
        $data->appends($request->except('page')); // Ensure category filter is kept in pagination links

        if ($request->ajax()) {
            // For AJAX requests, return a partial view containing the gallery items and pagination
            // This partial view needs to be created or ensured it has the correct structure
            return view('partial.gallery', ['gallery' => $data, 'categories' => $categories]);
        };
        return view('gallery', ['gallery' => $data, 'categories' => $categories]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('gallery.show',['gallery' => $gallery]);
    }
}
