<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UkuranBajuController extends Controller
{
    public function index()
    {
        return view('ukuran-baju.index');
    }
}
