<?php

namespace App\Http\Controllers;

use App\Models\News;
// use App\Http\Requests\StoreNewsRequest;
// use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('news', ['news' => News::all(),]);
    }



    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('news.show', ['news' => $news]);
    }
}