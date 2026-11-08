<?php

namespace App\Http\Controllers\Admin;

use App\Data\NewsData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use App\Services\NewsService;

class NewsController extends Controller
{
    public function __construct(private NewsService $service) {}

    public function index()
    {
        return view('admin.news.index');
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(StoreNewsRequest $request)
    {
        $this->service->create(
            NewsData::fromArray($request->validated()),
            $request->file('images', [])
        );

        return redirect()->route('admin.news')->with('success', 'Berita berhasil dibuat!');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        $this->service->update($news, NewsData::fromArray($request->validated()));

        return redirect()->route('admin.news')
            ->with('success', 'Berita berhasil diubah.');
    }

    public function destroy(News $news)
    {
        $this->service->delete($news);

        return redirect()->route('admin.news')->with('success', 'Berita berhasil dihapus.');
    }
}
