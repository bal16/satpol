<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware(['auth',])->group(function () {
    Route::get('/dashboard', function () {
        return view("admin.dashboard");
    })->name('dashboard');
});

Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/news', function () {
    return view('news');
})->name('news');
Route::get('/news/{slug}', function () {
    return view('news');
});

Route::get('/services', function () {
    return view('services');
})->name('services');
Route::get('/services/{slug}', function () {
    return view('services');
});

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

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
