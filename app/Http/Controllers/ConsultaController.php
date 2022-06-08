<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Grado;
use App\Models\Turno;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index(Request $request)
    {

        $grado = Grado::all();
        $turno = Turno::all();

        if(empty($request->grado)){
            $search_grado = 1;
        }else{
            $search_grado = $request->grado;
        }

        if(empty($request->turno)){
            $search_turno = 1;
        }else{
            $search_turno = $request->turno;
        }

        $alumno = Alumno::where('grado_id', $search_grado)
        ->where('turno_id', $search_turno)
        ->paginate(10);

        return view('consulta.index', compact('grado', 'turno', 'search_turno', 'search_grado', 'alumno'));

    }
}
