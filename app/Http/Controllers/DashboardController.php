<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('inicio');
    }

    public function www()
    {
        $data = Noticia::where('estado_id', 1)
        ->latest()
        ->take(5)
        ->get();

        return view('welcome', compact('data'));
    }

    public function nosotros()
    {

    }

    public function cursos()
    {

    }

    public function contacto()
    {

    }

    public function new()
    {

    }

    public function new_detalle($slug)
    {

    }
}
