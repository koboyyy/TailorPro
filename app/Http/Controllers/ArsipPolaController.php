<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArsipPolaController extends Controller
{
    public function index()
    {
        return view('arsip-pola.index');
    }
}
