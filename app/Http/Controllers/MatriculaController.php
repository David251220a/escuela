<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatriculaRequest;
use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\Cobro;
use App\Models\Grado;
use App\Models\Matricula;
use App\Models\Matricula_Cuota;
use App\Models\ParametroGeneral;
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

        $fecha = Carbon::now();

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

        if($request->paga_matricula == 1){
            $monto_matricula_cobrar = str_replace('.', '', $request->matricula_cobrar);
            $tipo_cobro = $request->tipo_cobro;

            $cobro = Cobro::create([
                'caja_id' => 1,
                'sede_id' => 1,
                'fecha_cobro' => $fecha,
                'estado_id' => 1,
                'cobro_concepto_id' => 1,
                'total_cobrado' => $monto_matricula_cobrar,
                'observacion' => 'COBRO DE MATRICULA',
                'tipo_cobro_id' => $tipo_cobro,
                'salida_id' => 1,
                'recibo_id' => 1,
                'usuario_alta' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);

            $cobro->cobro_matricula()->create([
                'factura_sucursal' => '000',
                'factura_general' => '000',
                'factura_nro' => '000000',
                'monto_total_factura' => $matricula->monto_matricula,
                'monto_saldo_factura' => ($matricula->monto_matricula - $monto_matricula_cobrar),
                'monto_cobrado_factura' => $monto_matricula_cobrar,
                'matricula_id' => $matricula->id,
                'estado_id' => 1,
                'usuario_alta' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);

        }

        return redirect()->route('matricula.index')->with('message', 'Se creo con exito la matricula.');

    }

    public function show(Matricula $matricula)
    {
        $matricula_cuota = Matricula_Cuota::where('matricula_id', $matricula->id)
        ->where('estado_id', 1)
        ->get();

        $paramentro_general = ParametroGeneral::first();
        $tipo_cobro = TipoCobro::where('estado_id', 1)
        ->get();

        return view('matricula.show', compact('matricula', 'matricula_cuota', 'paramentro_general', 'tipo_cobro'));
    }

    public function buscar_alumno(Request $request)
    {
        $cedula = str_replace('.', '', $request->cedula);

        $data = Alumno::where('cedula', $cedula)
        ->first();

        return response()->json($data);

    }

}
