<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingPage');
});

Route::get('/ukuran-baju', function () {
    return view('ukuran-baju.index');
});

