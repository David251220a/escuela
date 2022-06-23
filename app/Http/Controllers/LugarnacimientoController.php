<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LugarNacimiento;

class LugarnacimientoController extends Controller
{
    //
    public function index(Request $request)
    {
        //consulta a la Base de Datos
        $lugar_nacimiento =  Lugarnacimiento::where('estado_id',1)->get();
        //esto es para ver que trae
        // dd($alergias);
        //para retornar a la vista
        return view('secundaria.lugarnacimiento.index', compact('lugar_nacimiento'));
    }
}
