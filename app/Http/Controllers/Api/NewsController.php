<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    public function __construct(private NewsService $news) {}

    public function index()
    {
        return response()->json(['news' => $this->news->paginate(null, 1000)->items()]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->news->dataTableQuery())
                ->addIndexColumn()
                ->editColumn('created_at', function ($item) {
                    return $item->created_at ? $item->created_at->format('M d, Y H:i') : '-';
                })
                ->editColumn('updated_at', function ($item) {
                    return $item->updated_at ? $item->updated_at->format('M d, Y H:i') : '-';
                })
                ->addColumn('action', function ($item) {
                    $deleteUrl = route('admin.news.destroy', $item->id);
                    $csrfToken = csrf_token();

                    return '<a href="'.route('admin.news.edit', $item->id).'" class="edit-news-btn cursor-pointer text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</a>'.
                        '<form action="'.$deleteUrl.'" method="POST" class="inline-block" >'.
                        '<input type="hidden" name="_token" value="'.$csrfToken.'">'.
                        '<input type="hidden" name="_method" value="DELETE">'.
                        '<button type="submit" class="text-red-600 hover:text-red-900 cursor-pointer dark:text-red-400 dark:hover:text-red-300" >Delete</button>'.
                        '</form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return response()->json(['error' => 'Unauthorized action.'], 401);
    }

    public function show(News $news)
    {
        return response()->json([
            'news' => $news,
            'body' => $this->news->toTrixHtml($news->body),
        ]);
    }
}
