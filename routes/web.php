<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EncryptionController;

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
    Route::resource('/encryption', EncryptionController::class);
    Route::get('/encryption/download/{file}', [EncryptionController::class, 'download'])->name('download.file');
    Route::get('/encryption/delete/{id}', [EncryptionController::class, 'delete']);
});
