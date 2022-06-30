<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AnulacionController extends Controller
{
    public function index()
    {
        return view('anulacion.index');
    }

    public function show(Alumno $alumno)
    {
        return view('anulacion.show', compact('alumno'));
    }
}
