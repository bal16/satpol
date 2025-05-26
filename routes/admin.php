<?php

use App\Http\Controllers\Admin;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\Api;


Route::prefix('/admin')->middleware([AdminAuth::class])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // News Routes
    Route::get('/news', [Admin\NewsController::class, 'index'])->name('admin.news');
    Route::get('/news/create', [Admin\NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [Admin\NewsController::class, 'store'])->name('admin.news.store');
    Route::put('/news/{news}', [Admin\NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{news}', [Admin\NewsController::class, 'destroy'])->name('admin.news.destroy');
    Route::get('api/news/data', [Api\NewsController::class, 'data'])->name('news.data'); // Data source for DataTables

    Route::get('/gallery', [Admin\GalleryController::class, 'index'])->name('admin.gallery');
});

// use App\Http\Middleware\AdminAuth;
