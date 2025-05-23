<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::prefix('/admin')->group(function () {
    Route::get(
        '/login',
        [LoginController::class, 'create']
    )->name('login');

    Route::get(
        "/register",
        [RegisterController::class, 'create']
    )->name('register');

    Route::post(
        '/login',
        [LoginController::class, 'store']
    )->name('login.store');

    Route::post(
        "/register",
        [RegisterController::class, 'store']
    )->name('register.store');

    Route::delete(
        '/logout',
        [LoginController::class, 'destroy']
    )->name('logout');
});