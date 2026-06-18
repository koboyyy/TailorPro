<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UkuranBajuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ArsipPolaController;
use App\Http\Controllers\AuthController;

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/ukuran-baju', [UkuranBajuController::class, 'index']);
Route::get('/pesanan', [PesananController::class, 'index']);
Route::get('/data-pelanggan', [DataPelangganController::class, 'index']);
Route::get('/laporan', [LaporanController::class, 'index']);
Route::get('/arsip-pola', [ArsipPolaController::class, 'index']);

Route::get('/hasilan-pola', function () {
    return view('hasilan-pola.index');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

