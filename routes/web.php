<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PeriodController;
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


// period
Route::get('/periods', [PeriodController::class, 'page'])->name('periods');
Route::get('/api/periods', [PeriodController::class, 'index'])->name('api.periods.index');
Route::get('/api/periods/{id}', [PeriodController::class, 'find'])->name('api.periods.find');
Route::post('/api/periods', [PeriodController::class, 'store'])->name('api.periods.store');
Route::delete('/api/periods/{id}', [PeriodController::class, 'destroy'])->name('api.periods.destroy');
Route::put('/api/periods/{id}', [PeriodController::class, 'update'])->name('api.periods.update');

Route::get('/token', function () {
    return csrf_token();
});
