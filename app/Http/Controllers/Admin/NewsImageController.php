<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsImageController extends Controller
{
    /**
     * Store newly uploaded images for a news item.
     */
    public function store(Request $request, News $news)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validate each image
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                // Store in storage/app/public/news_images/{news_id}/filename.ext
                $path = $imageFile->store('news_images/' . $news->id, 'public');
                $news->images()->create(['path' => $path]);
            }
        }

        return back()->with('success', 'Gambar berhasil diunggah.');
    }

    /**
     * Remove the specified image from storage and database.
     */
    public function destroy(NewsImage $image) // Route model binding for NewsImage
    {
        // Ensure the user is authorized to delete this image, if necessary

        // Delete the file from storage
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        // Delete the record from the database
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
