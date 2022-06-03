<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatriculaRequest;
use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\Grado;
use App\Models\Matricula;
use App\Models\TipoCobro;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{

    public function index(Request $request)
    {
        return view('matricula.index');
    }

    public function create()
    {
        $ciclo = Ciclo::where('estado_id', 1)
        ->get();
        $grado = Grado::where('estado_id', 1)
        ->get();
        $turno = Turno::where('estado_id', 1)
        ->get();
        $tipo_cobro = TipoCobro::where('estado_id', 1)
        ->get();

        return view('matricula.create', compact('ciclo', 'grado', 'turno', 'tipo_cobro'));
    }

    public function store(MatriculaRequest $request)
    {
        $cedula = str_replace('.', '', $request->cedula);
        $monto_matricula = str_replace('.', '', $request->matricula);
        $monto_cuota = str_replace('.', '', $request->monto_cuota);
        $date = Carbon::now();
        $alumno = Alumno::where('cedula', $cedula)
        ->first();

        if(empty($alumno)){
            return redirect()->back()->with('message', 'No existe alumno con este nro. de cedula: ' .$cedula);
        }

        $matricula = Matricula::create([
            'alumno_id' => $alumno->id,
            'ciclo_id' => $request->ciclo,
            'grado_id' => $request->grado,
            'turno_id' => $request->turno,
            'estado_id' => 1,
            'fecha' => $date,
            'monto_matricula' => $monto_matricula,
            'monto_cuota' => $monto_cuota,
            'fecha_inicio' => date_format(date_create($request->fecha_cuota[0]), "Y-m-d"),
            'usuario_alta' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
            'cantidad_cuota' => $request->cantidad_cuota,
        ]);

        for ($i=0; $i < $request->cantidad_cuota; $i++) {

            $matricula->cuotas()->create([
                'fecha_vencimiento' => date_format(date_create($request->fecha_cuota[$i]), "Y-m-d"),
                'monto_cuota_cobrar' => $monto_cuota,
                'monto_cuota_cobrado' => 0,
                'monto_multa_cobrar' => 0,
                'monto_multa_cobrado' => 0,
                'monto_cobrado' => 0,
                'saldo' => 0,
                'total_cuota' => $monto_cuota,
                'usuario_alta' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
                'estado_id' => 1,
            ]);
        }

        return redirect()->route('matricula.index')->with('message', 'Se creo con exito la matricula.');

    }

    public function show(){

    }

    public function buscar_alumno(Request $request)
    {
        $cedula = str_replace('.', '', $request->cedula);

        $data = Alumno::where('cedula', $cedula)
        ->first();

        return response()->json($data);

    }

}
