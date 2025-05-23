<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\AdminAuth;


Route::prefix('/admin')->middleware([AdminAuth::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// use App\Http\Middleware\AdminAuth;



