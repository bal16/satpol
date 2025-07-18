<?php

namespace App\Http\Controllers\Api;

use App\Models\Gallery;
// use App\Http\Requests\StoreNewsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
// use App\Http\Requests\UpdateNewsRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['gallery' => Gallery::all(),]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        if ($request->ajax()) {
            // Eager load category relationship
            $gallery = Gallery::with('category')->select(['id', 'title', 'path', 'category_id', 'created_at', 'updated_at'])->latest();

            return DataTables::of($gallery)
                ->addIndexColumn() // Tambahkan baris ini untuk nomor urut

                ->editColumn('path', function ($item) {
                    return asset('storage/' . $item->path);
                })
                ->addColumn('category_name', function (Gallery $gallery) {
                    return $gallery->category ? $gallery->category->name : 'N/A';
                })
                // Hide original category_id from being sent to client if not needed directly
                // Or keep it if your edit logic relies on it directly from DT row data
                // ->removeColumn('category_id')
                ->editColumn('created_at', function ($item) {
                    return $item->created_at ? $item->created_at->format('M d, Y H:i') : '-';
                })
                ->editColumn('updated_at', function ($item) {
                    return $item->updated_at ? $item->updated_at->format('M d, Y H:i') : '-';
                })
                ->addColumn('action', function ($item) {
                    // Ensure you have these routes defined (e.g., admin.news.edit, admin.news.destroy)
                    // Or adjust to your actual route structure and naming.
                    // $editUrl = route('admin.news.edit', $item->id); // Example route name
                    $deleteUrl = route('admin.gallery.destroy', $item->id); // Example route name
                    $csrfToken = csrf_token();

                    return '<button type="button" id="' . $item->id . '" class="edit-gallery-btn cursor-pointer text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</button>' .
                        '<form action="' . $deleteUrl . '" method="POST" class="inline-block" onsubmit="return confirm(\'Are you sure you want to delete this item?\');">' .
                        '<input type="hidden" name="_token" value="' . $csrfToken . '">' .
                        '<input type="hidden" name="_method" value="DELETE">' .
                        '<button type="submit" class="cursor-pointer text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>' .
                        '</form>';
                })
                ->rawColumns(['action']) // Important to render HTML in the action column
                ->make(true);
        }
        // Fallback or error if not an AJAX request
        return response()->json([
            'message' => 'Unauthorized action.'
        ], 403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return response()->json(['gallery' => $gallery]);
    }
}
