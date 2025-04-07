<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\AuthUser;

// auth
Route::get('/login', [AuthController::class, 'page'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

// auth routes
Route::middleware(AuthUser::class)->group(function () {
    Route::get('/', function () {
        return view('pages.example');
    })->name('dashboard');

    // employee
    Route::get('/employees', [EmployeeController::class, 'page'])->name('employees');
    Route::get('/api/employees', [EmployeeController::class, 'index'])->name('api.employees.index');
    Route::get('/api/employees/find', [EmployeeController::class, 'find'])->name('api.employees.find');
    Route::post('/api/employees', [EmployeeController::class, 'store'])->name('api.employees.store');
    Route::delete('/api/employees', [EmployeeController::class, 'destroy'])->name('api.employees.destroy');
    Route::put('/api/employees', [EmployeeController::class, 'update'])->name('api.employees.update');
});
