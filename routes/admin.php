<?php

use App\Http\Controllers\Api;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\NewsImageController;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\AttachmentsController;

Route::prefix('/admin')->middleware([AdminAuth::class])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // News Routes
    Route::get('/news', [Admin\NewsController::class, 'index'])->name('admin.news');
    Route::get('/news/create', [Admin\NewsController::class, 'create'])->name('admin.news.create'); // Pastikan ini sudah benar
    Route::post('/news', [Admin\NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{news}', [Api\NewsController::class, 'show'])->name('admin.news.show');
    Route::get('/news/{news}/edit', [Admin\NewsController::class, 'edit'])->name('admin.news.edit'); // Changed PUT to GET
    Route::put('/news/{news}', [Admin\NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{news}', [Admin\NewsController::class, 'destroy'])->name('admin.news.destroy');
    Route::get('api/news/data', [Api\NewsController::class, 'data'])->name('news.data'); // Data source for DataTables

    // News Images Routes
    Route::post('/news/{news}/images', [NewsImageController::class, 'store'])->name('admin.news.images.store');
    Route::delete('/news/images/{image}', [NewsImageController::class, 'destroy'])->name('admin.news.images.destroy');

    Route::get('/gallery', [Admin\GalleryController::class, 'index'])->name('admin.gallery');
    Route::get('/gallery/create', [Admin\GalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('/gallery', [Admin\GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::put('/gallery/{gallery}', [Admin\GalleryController::class, 'update'])->name('admin.gallery.update');
    Route::delete('/gallery/{gallery}', [Admin\GalleryController::class, 'destroy'])->name('admin.gallery.destroy');
    Route::get('api/gallery/data', [Api\GalleryController::class, 'data'])->name('gallery.data'); // Data source for DataTables
    Route::get('api/categories/list', [Admin\CategoryController::class, 'list'])->name('api.categories.list');

    // Category Routes (for Gallery Page Category Management)
    Route::get('api/categories/data', [Admin\CategoryController::class, 'data'])->name('admin.categories.data');
    Route::post('/categories', [Admin\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/categories/{category}', [Admin\CategoryController::class, 'update'])->name('admin.categories.update'); // Matched with JS fetch
    Route::delete('/categories/{category}', [Admin\CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/sliders', [Admin\SliderController::class, 'index'])->name('admin.sliders');
    Route::patch('/sliders/update/{slot_number}', [Admin\SliderController::class, 'update'])->name('admin.sliders.update');

    // Profile Page Items (using Admin\ProfileController and ProfileItems model)
    Route::get('/profile', [Admin\ProfileController::class, 'index'])->name('admin.profile');
    Route::get('/profile/{profileItem}/edit', [Admin\ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile/{profileItem}', [Admin\ProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/profile/sop', [Admin\SOPController::class, 'index'])->name('admin.profile.sop');
    Route::post('/profile/sop', [Admin\SOPController::class, 'store'])->name('admin.profile.sop.store');
    Route::delete('/profile/sop/{SOP}', [Admin\SOPController::class, 'destroy'])->name('admin.profile.sop.destroy');
    Route::put('/profile/sop/{SOP}', [Admin\SOPController::class, 'update'])->name('admin.profile.sop.update');

    Route::post('attachments', AttachmentsController::class)
        ->name('attachments.store');
});

// use App\Http\Middleware\AdminAuth;
