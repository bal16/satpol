<?php

namespace App\Http\Controllers;

use App\Models\Category; // Import Category model
use App\Models\Gallery;
// use App\Http\Requests\StoreGalleryRequest;
// use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        // Fetch categories that have at least one gallery item
        $categories = Category::whereHas('galleries')
                                ->orderBy('name')
                                ->get();
        $selectedCategoryId = $request->input('category_id');

        $query = Gallery::query();

        if ($selectedCategoryId) {
            $query->where('category_id', $selectedCategoryId);
        }

        $data = $query->orderBy('created_at', 'desc')->paginate(12);
        $data->appends($request->except('page')); // Ensure category filter is kept in pagination links

        if ($request->ajax()) {
            // For AJAX requests, return a partial view.
            // Passing $categories and $selectedCategoryId might be useful if the partial evolves.
            return view('partial.gallery', [
                'gallery' => $data,
                'selectedCategoryId' => $selectedCategoryId // Pass selectedCategoryId for lightbox grouping
            ]);
        }
        // For initial page load, pass all necessary data.
        // $selectedCategoryId can be derived in the view using request() helper if preferred.
        return view('gallery', ['gallery' => $data, 'categories' => $categories]);
    }

}