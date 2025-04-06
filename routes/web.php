<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// auth
Route::get('/login', [AuthController::class, 'page']);
