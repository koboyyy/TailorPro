<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataPelangganController extends Controller
{
    public function index()
    {
        return view('data-pelanggan.index');
    }
}
