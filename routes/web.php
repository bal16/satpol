<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', DashboardController::class)->name('home');

Route::get('/profile', ProfileController::class)->name('profile');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/services', function () {
    return view('services');
})->name('services');
// Route::get('/services/{slug}', function () {
//     return view('services');
// });

Route::get('/services/pajak-daftar', function () {
    return view('pajak-info', ['type' => 'daftar']);
})->name('services.pajak-daftar');
Route::get('/services/tempo-pajak', function () {
    return view('pajak-info', ['type' => 'tempo']);
})->name('services.pajak-tempo');


Route::get('/gallery', GalleryController::class)->name('gallery');


Route::prefix('/info')
    ->group(function () {
        Route::get('/ppid', function () {
            return view('ppid');
        });
        Route::get('/perda', function () {
            return view('perda');
        });
        Route::get('/sop', function () {
            return view('sop');
        });
    });