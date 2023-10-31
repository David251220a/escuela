<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\Matricula;
use App\Models\Matricula_Cuota;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InicioController extends Controller
{

    public function __construct()
    {
    }

    public function index(){

        return view('dashboard');
    }

    public function estado_cuenta()
    {
        $ciclo = Ciclo::where('estado_id', 1)
        ->first();

        $user = auth()->user();
        $data = Matricula_Cuota::where('matricula_id', 0)
        ->get();

        $data = [];
        $matricula =[];
        $alumno = Alumno::where('cedula', $user->documento)->first();

        if ($alumno) {

            $matricula = Matricula::where('alumno_id', $alumno->id)
            ->where('estado_id', 1)
            ->where('ciclo_id', $ciclo->id)
            ->first();

            if ($matricula){
                $data = Matricula_Cuota::where('matricula_id', $matricula->id)
                ->get();
            }
        }

        return view('principal.estado_cuenta', compact('data', 'alumno', 'matricula'));
    }
}
