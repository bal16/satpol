<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct(private NewsService $news) {}

    public function index(Request $request)
    {
        $news = $this->news->paginate($request->input('search'), 5);
        $latest = $this->news->latest(5);

        if ($request->ajax()) {
            return view('partial.news', ['news' => $news]);
        }

        return view('news.index', ['news' => $news, 'latest' => $latest]);
    }

    public function show(News $news)
    {
        return view('news.show', [
            'news' => $news,
            'latest' => $this->news->latest(4),
        ]);
    }
}
