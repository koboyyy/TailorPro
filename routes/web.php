<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UkuranBajuController;
use App\Http\Controllers\HasilkanPolaController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ArsipPolaController;
use App\Http\Controllers\AuthController;


Route::get('/', [LandingPageController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/ukuran-baju', [UkuranBajuController::class, 'index']);
Route::post('/ukuran-baju/simpan', [UkuranBajuController::class, 'store'])->name('ukuran-baju.store');
Route::delete('/ukuran-baju/{id}', [UkuranBajuController::class, 'destroy'])->name('ukuran-baju.destroy');
Route::get('/pesanan', [PesananController::class, 'index']);
Route::get('/data-pelanggan', [DataPelangganController::class, 'index']);
Route::post('/data-pelanggan/simpan', [DataPelangganController::class, 'store'])->name('data-pelanggan.store');
Route::put('/data-pelanggan/{id}', [DataPelangganController::class, 'update'])->name('data-pelanggan.update');
Route::delete('/data-pelanggan/{id}', [DataPelangganController::class, 'destroy'])->name('data-pelanggan.destroy');
Route::get('/laporan', [LaporanController::class, 'index']);
Route::get('/arsip-pola', [ArsipPolaController::class, 'index']);
Route::delete('/arsip-pola/{id}', [ArsipPolaController::class, 'destroy'])->name('arsip-pola.destroy');

Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
Route::post('/pesanan/simpan', [PesananController::class, 'store'])->name('pesanan.store');
Route::post('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.destroy');

Route::get('/hasilkan-pola', [HasilkanPolaController::class, 'index']);
Route::post('/hasilkan-pola/simpan', [HasilkanPolaController::class, 'store'])->name('hasilkan-pola.store');
Route::post('/hasilkan-pola/get-ukuran-pelanggan', [HasilkanPolaController::class, 'getUkuranPelanggan']);


// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





