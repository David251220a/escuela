<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnulacionController extends Controller
{
    public function index()
    {
        return view('anulacion.index');
    }
}
