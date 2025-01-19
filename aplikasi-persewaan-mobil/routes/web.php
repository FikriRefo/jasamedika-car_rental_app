<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;

Route::get('register', [AuthController::class, 'indexregister'])->name('register.index');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('login', [AuthController::class, 'index'])->name('login.index');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // Mobil
    Route::get('/mobil', [HomeController::class, 'mobil'])->name('mobil.index');
    Route::get('/mobil/create', [HomeController::class, 'create'])->name('mobil.create');
    Route::get('/mobil/search', [HomeController::class, 'search'])->name('mobil.search');
    Route::post('/mobil', [HomeController::class, 'store'])->name('mobil.store');
    Route::get('/mobil/{id}/edit', [HomeController::class, 'edit'])->name('mobil.edit');
    Route::put('/mobil/{id}', [HomeController::class, 'update'])->name('mobil.update');
    Route::delete('/mobil/{id}', [HomeController::class, 'destroy'])->name('mobil.destroy');
    // Rental
    Route::get('/peminjaman', [RentalController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [RentalController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [RentalController::class, 'store'])->name('peminjaman.store');
    // Return
    Route::get('/returns', [ReturnController::class, 'index'])->name('returns.index');
    Route::get('/returns/create', [ReturnController::class, 'create'])->name('returns.create');
    Route::post('/returns', [ReturnController::class, 'store'])->name('returns.store');
});
