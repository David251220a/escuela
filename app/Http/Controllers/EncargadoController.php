<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EncargadoController extends Controller
{
    public function index()
    {
        return view('padres.encargado');
    }
}
