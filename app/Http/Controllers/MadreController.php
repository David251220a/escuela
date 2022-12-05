<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MadreController extends Controller
{

    public function index(Request $request)
    {
        $titulo = 'Madre';
        return view('padres.index', compact('titulo'));
    }

}
