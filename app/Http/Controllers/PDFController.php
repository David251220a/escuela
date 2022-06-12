<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\CobroIngreso;
use App\Models\Grado;
use App\Models\Matricula_Cuota;
use App\Models\Turno;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Luecano\NumeroALetras\NumeroALetras;

class PDFController extends Controller
{

    public function imprimir_cobro_cuota($id){

        $matricula_cuota = Matricula_Cuota::where('id', $id)
        ->first();
        $formatter = new NumeroALetras();

        $PDF = PDF::loadView('documentos.comprobante_cobro_cuota', compact('matricula_cuota', 'formatter'));

        return $PDF->stream();
    }

    public function alumno_grado_turno($search_grado, $search_turno)
    {
        $alumno = Alumno::where('grado_id', $search_grado)
        ->where('turno_id', $search_turno)
        ->paginate(10);
        $grado = Grado::find($search_grado);
        $turno = Turno::find($search_turno);

        $PDF = PDF::loadView('documentos.consulta_grado_turno', compact('alumno', 'turno', 'grado'));

        return $PDF->stream();
    }

    public function ingreso_grado_turno($grado, $turno, $ingreso, $fecha_desde, $fecha_hasta){

        $alumno = Alumno::where('grado_id', $grado)
        ->where('turno_id', $turno)
        ->where('estado_id', 1)
        ->orderBy('apellido', 'ASC')
        ->get();

        $ingreso_hasta = 0;
        if($ingreso == 9999){
            $ingreso_hasta = 0;
        }else{
            $ingreso_hasta = $ingreso;
        }

        $cobros = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
        ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
        ->where('cobro.cobro_concepto_id', 3)
        ->where('cobro.estado_id', 1)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$fecha_desde, $fecha_hasta])
        ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $ingreso)
        ->where('cobro_ingreso.cobro_ingreso_concepto', '>=', $ingreso_hasta)
        ->get();

    }

}
