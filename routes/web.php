<?php

use Illuminate\Support\Facades\Route;

// 1. Import SEMUA controller yang kita gunakan
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;

// Route untuk halaman utama (welcome/dashboard)
Route::get('/', function () {
    return view('welcome');
});

// 2. Daftarkan Route::resource untuk SETIAP controller CRUD
Route::resource('departments', DepartmentController::class);
Route::resource('positions', PositionController::class);
Route::resource('employees', EmployeeController::class); // Ini sudah ada
Route::resource('attendances', AttendanceController::class);
Route::resource('salaries', SalaryController::class);