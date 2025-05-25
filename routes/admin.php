<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Middleware\AdminAuth;


Route::prefix('/admin')->middleware([AdminAuth::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/news', [NewsController::class, 'index'])->name('admin.news');
    Route::get('/gallery', [GalleryController::class, 'index'])->name('admin.gallery');
});

// use App\Http\Middleware\AdminAuth;



