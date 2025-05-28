<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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

    public function store(StoreGalleryRequest $request)
    {
        // Validation is handled by StoreGalleryRequest.
        // If validation fails, StoreGalleryRequest will automatically
        // return a JSON response with errors due to the 'Accept: application/json' header from fetch.

        $gallery = new Gallery();
        $gallery->title = $request->input('title');
        $gallery->category = $request->input('category');

        if ($request->hasFile('path') && $request->file('path')->isValid()) {
            $uploadedFile = $request->file('path');
            // Store the file in 'storage/app/public/gallery_photos'
            // The store method on the 'public' disk will return a path like 'gallery_photos/filename.ext'
            $storedPath = $uploadedFile->store('gallery_photos', 'public');

            if ($storedPath) {
                $gallery->path = $storedPath;
            } else {
                // This case is rare as store() usually throws an exception on critical failure
                // Log this error for investigation
                return response()->json(['message' => 'Could not save the uploaded file. Please check server logs and permissions.'], 500);
            }
        }

        $gallery->save();

        return response()->json([
            'message' => 'Galeri berhasil ditambahkan!',
            'gallery' => $gallery // Optionally return the created gallery item
        ], 201);
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
    // public function store(StoreGalleryRequest $request)
    // {
    //     Gallery::create([
    //         'title' => $request->title,
    //         'path' => $request->path,
    //         'category' => $request->category,
    //     ]);

    //     // return redirect(route('admin.gallery'));
    //     return response()->json([
    //         'message' => 'Gallery created successfully',
    //         'status' => true
    //     ]);
    // }

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
        // Validation is handled by UpdateGalleryRequest.

        $gallery->title = $request->input('title');
        $gallery->category = $request->input('category');

        if ($request->hasFile('path') && $request->file('path')->isValid()) {
            $newUploadedFile = $request->file('path');

            // Delete the old image if it exists
            if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
                Storage::disk('public')->delete($gallery->path);
            }

            // Store the new file in 'storage/app/public/gallery_photos'
            // The store method on the 'public' disk will return a path like 'gallery_photos/filename.ext'
            $newStoredPath = $newUploadedFile->store('gallery_photos', 'public');

            if ($newStoredPath) {
                $gallery->path = $newStoredPath;
            } else {
                return response()->json(['message' => 'Could not save the new uploaded file. Please check server logs and permissions.'], 500);
            }
        }
        // If no new file is uploaded, the existing $gallery->path remains unchanged.

        $gallery->save();

        return response()->json([
            'message' => 'Galeri berhasil diperbarui!',
            'gallery' => $gallery // Optionally return the updated gallery item
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete the image file from storage if it exists
        if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
            Storage::disk('public')->delete($gallery->path);
        }

        $gallery->delete(); // Deletes the model instance from DB

        // For AJAX, a JSON response is better, assuming your frontend handles it
        return response()->json([
            'message' => 'Galeri berhasil dihapus!',
            'status' => true
        ]);
        // If you prefer a redirect for non-AJAX or specific scenarios:
        // return redirect()->route('admin.gallery')->with('success', 'Galeri berhasil dihapus!');
    }
}
