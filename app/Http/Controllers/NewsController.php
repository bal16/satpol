<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
// use App\Http\Requests\StoreNewsRequest;
// use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $news = News::query()->orderBy('created_at', 'desc')->paginate(5)->appends($request->except('page')); 

        if ($request->ajax()) {
            return view('partial.news', ['news' => $news]);
        }

        return view('news', ['news' => $news,]);
    }



    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('news.show', ['news' => $news]);
    }
}