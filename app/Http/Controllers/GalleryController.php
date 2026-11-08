<?php

namespace App\Http\Controllers;

use App\Services\GalleryService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct(private GalleryService $gallery) {}

    public function __invoke(Request $request)
    {
        $selectedCategoryId = $request->input('category_id');

        $data = $this->gallery->paginate($selectedCategoryId ? (int) $selectedCategoryId : null, 12);
        $data->appends($request->except('page'));

        $categories = $this->gallery->categoriesWithGalleries();

        if ($request->ajax()) {
            return view('partial.gallery', [
                'gallery' => $data,
                'selectedCategoryId' => $selectedCategoryId,
            ]);
        }

        return view('gallery', ['gallery' => $data, 'categories' => $categories]);
    }
}
