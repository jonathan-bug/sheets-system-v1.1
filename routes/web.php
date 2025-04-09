<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\HourController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\SheetController;
use App\Http\Middleware\AuthUser;
use App\Utility\Loader;

// auth
Route::get('/login', [AuthController::class, 'page'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

// auth routes
Route::middleware(AuthUser::class)->group(function () {
    Route::get('/', function () {
        Loader::load();
        
        return view('pages.example');
    })->name('dashboard');

    // employee
    Route::get('/employees', [EmployeeController::class, 'page'])->name('employees');
    Route::get('/api/employees', [EmployeeController::class, 'index'])->name('api.employees.index');
    Route::get('/api/employees/find', [EmployeeController::class, 'find'])->name('api.employees.find');
    Route::post('/api/employees', [EmployeeController::class, 'store'])->name('api.employees.store');
    Route::delete('/api/employees', [EmployeeController::class, 'destroy'])->name('api.employees.destroy');
    Route::put('/api/employees', [EmployeeController::class, 'update'])->name('api.employees.update');

    // period
    Route::get('/periods', [PeriodController::class, 'page'])->name('periods');
    Route::get('/api/periods', [PeriodController::class, 'index'])->name('api.periods.index');
    Route::get('/api/periods/{id}', [PeriodController::class, 'find'])->name('api.periods.find');
    Route::post('/api/periods', [PeriodController::class, 'store'])->name('api.periods.store');
    Route::delete('/api/periods/{id}', [PeriodController::class, 'destroy'])->name('api.periods.destroy');
    Route::put('/api/periods/{id}', [PeriodController::class, 'update'])->name('api.periods.update');
    Route::get('/api/periods/load/{id}', [PeriodController::class, 'load'])->name('api.periods.load');

    // salaries
    Route::get('/salaries/{dui}', [SalaryController::class, 'page'])->name('salaries');
    Route::get('/api/salaries/{dui}', [SalaryController::class, 'index'])->name('api.salaries.index');
    Route::get('/api/salaries/find/{id}', [SalaryController::class, 'find'])->name('api.salaries.find');
    Route::delete('/api/salaries/{id}', [SalaryController::class, 'destroy'])->name('api.salaries.destroy');
    Route::post('/api/salaries', [SalaryController::class, 'store'])->name('api.salaries.store');
    Route::put('/api/salaries/{id}', [SalaryController::class, 'update'])->name('api.salaries.update');

    // hours
    Route::get('/hours/{dui}', [HourController::class, 'page'])->name('hours');
    Route::get('/api/hours/{dui}', [HourController::class, 'index'])->name('api.hours.index');
    Route::get('/api/hours/find/{id}', [HourController::class, 'find'])->name('api.hours.find');
    Route::delete('/api/hours/{id}', [HourController::class, 'destroy'])->name('api.hours.destroy');
    Route::post('/api/hours', [HourController::class, 'store'])->name('api.hours.store');
    Route::put('/api/hours/{id}', [HourController::class, 'update'])->name('api.hours.update');

    // bonus
    Route::get('/bonus/{dui}', [BonusController::class, 'page'])->name('bonus');
    Route::get('/api/bonus/{dui}', [BonusController::class, 'index'])->name('api.bonus.index');
    Route::get('/api/bonus/find/{id}', [BonusController::class, 'find'])->name('api.bonus.find');
    Route::delete('/api/bonus/{id}', [BonusController::class, 'destroy'])->name('api.bonus.destroy');
    Route::post('/api/bonus', [BonusController::class, 'store'])->name('api.bonus.store');
    Route::put('/api/bonus/{id}', [BonusController::class, 'update'])->name('api.bonus.update');

    // generate
    Route::get('/sheets', [SheetController::class, 'page'])->name('sheets');
    Route::get('/api/sheets', [SheetController::class, 'index'])->name('api.sheets.index');
});

Route::get('/token', function () {
    return csrf_token();
});


