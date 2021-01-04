<?php

use Illuminate\Support\Facades\Route;

Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
Route::resource('/crud/{model}/resources', \App\Http\Controllers\ResourceController::class);
Route::get('/', function () {
    return view('welcome');
});
