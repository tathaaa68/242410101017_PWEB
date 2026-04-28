<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\LokerController;

Route::get('/', function () {return redirect()->route("dashboard");});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');

Route::get('/hitung/{a}/{b}', fn($a, $b) => $a + $b);