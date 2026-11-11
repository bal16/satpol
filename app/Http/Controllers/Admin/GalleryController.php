<?php

namespace App\Http\Controllers\Admin;

use App\Data\GalleryData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct(private GalleryService $service) {}

    public function index()
    {
        return view('admin.gallery');
    }

    public function store(StoreGalleryRequest $request)
    {
        $gallery = $this->service->create(
            GalleryData::fromArray($request->validated()),
            $request->file('photo')
        );

        return response()->json([
            'message' => 'Galeri berhasil ditambahkan!',
            'gallery' => $gallery,
        ], 201);
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $gallery = $this->service->update(
            $gallery,
            GalleryData::fromArray($request->validated()),
            $request->file('photo')
        );

        return response()->json([
            'message' => 'Galeri berhasil diperbarui!',
            'gallery' => $gallery,
        ], 200);
    }

    public function destroy(Request $request, Gallery $gallery)
    {
        $this->service->delete($gallery);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['message' => 'Galeri berhasil dihapus!'], 200);
        }

        return redirect()->route('admin.gallery');
    }
}
