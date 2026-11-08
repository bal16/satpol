<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    public function __construct(private GalleryService $gallery) {}

    public function index()
    {
        return response()->json(['gallery' => Gallery::all()]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->gallery->dataTableQuery())
                ->addIndexColumn()
                ->editColumn('path', function ($item) {
                    return asset('storage/'.$item->path);
                })
                ->addColumn('category_name', function (Gallery $gallery) {
                    return $gallery->category ? $gallery->category->name : 'N/A';
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at ? $item->created_at->format('M d, Y H:i') : '-';
                })
                ->editColumn('updated_at', function ($item) {
                    return $item->updated_at ? $item->updated_at->format('M d, Y H:i') : '-';
                })
                ->addColumn('action', function ($item) {
                    $deleteUrl = route('admin.gallery.destroy', $item->id);
                    $csrfToken = csrf_token();

                    return '<button type="button" id="'.$item->id.'" class="edit-gallery-btn cursor-pointer text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</button>'.
                        '<form action="'.$deleteUrl.'" method="POST" class="inline-block" onsubmit="return confirm(\'Are you sure you want to delete this item?\');">'.
                        '<input type="hidden" name="_token" value="'.$csrfToken.'">'.
                        '<input type="hidden" name="_method" value="DELETE">'.
                        '<button type="submit" class="cursor-pointer text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>'.
                        '</form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return response()->json(['message' => 'Unauthorized action.'], 403);
    }

    public function show(Gallery $gallery)
    {
        return response()->json(['gallery' => $gallery]);
    }
}
