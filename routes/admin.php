<?php

use App\Http\Controllers\Admin\DashboardController;



Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
})->middleware([]);
