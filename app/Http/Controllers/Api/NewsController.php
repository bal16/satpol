<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
// use App\Http\Requests\StoreNewsRequest;
use App\Http\Controllers\Controller;
// use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json( ['news' => News::all(),]);
    }



    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return response()->json(['news' => $news]);
    }
}