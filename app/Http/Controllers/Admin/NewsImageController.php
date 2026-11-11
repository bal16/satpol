<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsImage;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsImageController extends Controller
{
    public function __construct(private NewsService $service) {}

    public function store(Request $request, News $news)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->service->addImages($news, $request->file('images', []));

        return back()->with('success', 'Gambar berhasil diunggah.');
    }

    public function destroy(NewsImage $image)
    {
        $this->service->deleteImage($image);

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
