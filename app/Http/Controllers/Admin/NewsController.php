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
        return view('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {

        $news = News::create([
            'title' => $request->title,
            'author' => $request->author,
            'body' => $request->body,
            'slug' => $request->slug
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                // Store in storage/app/public/news_images/{news_id}/filename.ext
                $path = $imageFile->store('news_images/' . $news->id, 'public');
                $news->images()->create(['path' => $path]);
            }
        }
        return redirect()->route('admin.news')->with('success', 'Berita berhasil dibuat!');
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
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $news->update([
            'title' => $request->title,
            'author' => $request->author,
            'body' => $request->body,
            'slug' => $request->slug
        ]);

        return redirect()->route('admin.news')
            ->with('success', 'Berita berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        News::destroy($news->id);

        return redirect(route('admin.news'))->with('success', 'Berita berhasil dihapus.');
        // return response()->json([
        //     'message' => 'News deleted successfully',
        //     'status' => true
        // ]);
    }
}