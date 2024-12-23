<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('login.index', [
        "title" => "PT Buana Express",
        "active" => 'pt buana express'
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::prefix('/report')->group(function () {
    Route::get('/list', [ReportController::class, 'index'])->middleware('auth');
    Route::get('/add', [ReportController::class, 'add'])->middleware('auth');
});
