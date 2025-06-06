<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
// use App\Http\Requests\StoreNewsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
// use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['news' => News::all(),]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $news = News::select(['id', 'title', 'slug', 'created_at', 'updated_at']);

            return DataTables::of($news)
                ->addIndexColumn() // Tambahkan baris ini untuk nomor urut
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
                    $deleteUrl = route('admin.news.destroy', $item->id); // Example route name
                    $csrfToken = csrf_token();

                    return '<a href="' . route('admin.news.edit', $item->id) . '" class="edit-news-btn cursor-pointer text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</a>' .
                        '<form action="' . $deleteUrl . '" method="POST" class="inline-block" >' .
                        '<input type="hidden" name="_token" value="' . $csrfToken . '">' .
                        '<input type="hidden" name="_method" value="DELETE">' .
                        '<button type="submit" class="text-red-600 hover:text-red-900 cursor-pointer dark:text-red-400 dark:hover:text-red-300" >Delete</button>' .
                        '</form>';
                })
                ->rawColumns(['action']) // Important to render HTML in the action column
                ->make(true);
        }
        // Fallback or error if not an AJAX request
        return response()->json(['error' => 'Unauthorized action.'], 401);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return response()->json(['news' => $news, 'body' => $news->body->toTrixHtml()]);
    }
}
