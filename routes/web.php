<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingPage');
});

Route::get('/ukuran-baju', function () {
    return view('ukuran-baju.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/pesanan', function () {
    return view('pesanan.index');
});

Route::get('/data-pelanggan', function () {
    return view('data-pelanggan.index');
});

Route::get('/laporan', function () {
    return view('laporan.index');
});

Route::get('/hasilan-pola', function () {
    return view('hasilan-pola.index');
});

Route::get('/arsip-pola', function () {
    return view('arsip-pola.index');
});
