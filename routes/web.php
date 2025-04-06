<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthUser;

// auth
Route::get('/login', [AuthController::class, 'page'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

// auth routes
Route::middleware(AuthUser::class)->group(function () {
    Route::get('/', function () {
        return view('pages.example');
    })->name('dashboard');
});
