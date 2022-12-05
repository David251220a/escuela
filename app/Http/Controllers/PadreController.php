<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PadreController extends Controller
{
    public function index(){
        $titulo = 'Padre';
        return view('padres.index', compact('titulo'));
    }
}
