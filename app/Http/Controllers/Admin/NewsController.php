<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.news');
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
    public function store(StoreNewsRequest $request)
    {
        News::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json([
            'message' => 'News created successfully',
            'status' => true
        ]);
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(News $news)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(News $news)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $news->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        // return redirect(route('admin.news'));
        return response()->json([
            'message' => 'News updated successfully',
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        News::destroy($news->id);

        return redirect(route('admin.news'));
        // return response()->json([
        //     'message' => 'News deleted successfully',
        //     'status' => true
        // ]);
    }
}
