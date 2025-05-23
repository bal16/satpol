<?php

use App\Http\Controllers\AdminController;



Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
})->middleware([]);
