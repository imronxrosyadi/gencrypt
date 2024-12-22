<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login.welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/upload-data', function () {
    return view('upload-data');
});

Route::get('/report-data', function () {
    return view('report-data');
});
