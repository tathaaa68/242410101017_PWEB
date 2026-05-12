<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\KontakController;
use App\http\controllers\ManajemenMahasiswaController;

Route::get('/', function () {return redirect()->route("dashboard");});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
Route::post('/manajemen-mahasiswa', [ManajemenMahasiswaController::class, 'store'])->name('manajemen-mahasiswa.store');
Route::get('/manajemen-mahasiswa/create', [ManajemenMahasiswaController::class, 'create'])->name('manajemen-mahasiswa.create');
Route::get('/manajemen-mahasiswa/{id}', [ManajemenMahasiswaController::class, 'show'])->name('manajemen-mahasiswa.show');
Route::get('/manajemen-mahasiswa/{id}/edit', [ManajemenMahasiswaController::class, 'edit'])->name('manajemen-mahasiswa.edit');
Route::put('/manajemen-mahasiswa/{id}', [ManajemenMahasiswaController::class, 'update'])->name('manajemen-mahasiswa.update');
Route::delete('/manajemen-mahasiswa/{id}', [ManajemenMahasiswaController::class, 'destroy'])->name('manajemen-mahasiswa.destroy');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::get('/hitung/{a}/{b}', fn($a, $b) => $a + $b);


Route::middleware(['auth'])->group(function () {
    // rute lainnya...
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/manajemen-mahasiswa', [ManajemenMahasiswaController::class, 'index'])->name('manajemen-mahasiswa.index');

    Route::get('/admin', function () {
        return 'Selamat datang, Admin!';
    })->name('admin.dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
