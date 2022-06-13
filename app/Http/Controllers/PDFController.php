<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\CobroIngreso;
use App\Models\CobroIngresoConcepto;
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

    public function ingreso_grado_turno(Request $request)
    {

        $grado = $request->grado;
        $turno = $request->turno;
        $ingreso = $request->ingreso;
        $fecha_desde = $request->fecha_desde;
        $fecha_hasta = $request->fecha_hasta;

        $alumno = Alumno::where('grado_id', $grado)
        ->where('turno_id', $turno)
        ->where('estado_id', 1)
        ->orderBy('apellido', 'ASC')
        ->get();

        $ingreso_hasta = 0;
        if($ingreso == 9999){
            $ingreso_hasta = 0;
            $titulo = 'TODOS';
        }else{
            $ingreso_hasta = $ingreso;
            $aux_titulo = CobroIngresoConcepto::where('id', $ingreso)
            ->first();
            $titulo = $aux_titulo->nombre;
        }

        $grado_aux = Grado::find($grado);
        $turno_aux = Turno::find($turno);

        $cobros = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
        ->join('alumno', 'cobro_ingreso.alumno_id', '=', 'alumno.id')
        ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id', 'alumno.grado_id', 'alumno.turno_id', 'alumno.nombre', 'alumno.apellido')
        ->where('cobro.cobro_concepto_id', 3)
        ->where('cobro.estado_id', 1)
        ->where('alumno.grado_id', $grado)
        ->where('alumno.turno_id', $turno)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$fecha_desde, $fecha_hasta])
        ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $ingreso)
        ->where('cobro_ingreso.cobro_ingreso_concepto', '>=', $ingreso_hasta)
        ->orderBy('alumno.nombre', 'ASC')
        ->orderBy('alumno.apellido', 'ASC')
        ->get();

        $tipo_ingreso = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
        ->join('alumno', 'cobro_ingreso.alumno_id', '=', 'alumno.id')
        ->select('cobro_ingreso.cobro_ingreso_concepto')
        ->distinct()
        ->where('cobro.cobro_concepto_id', 3)
        ->where('cobro.estado_id', 1)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$fecha_desde, $fecha_hasta])
        ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $ingreso)
        ->where('cobro_ingreso.cobro_ingreso_concepto', '>=', $ingreso_hasta)
        ->where('alumno.grado_id', $grado)
        ->where('alumno.turno_id', $turno)
        ->get();

        if(($ingreso == 1) || ($ingreso == 2)) {
            $PDF = PDF::loadView('documentos.derecho_examen', compact('alumno'
            , 'turno_aux'
            , 'cobros'
            , 'grado_aux'
            , 'fecha_desde'
            , 'tipo_ingreso'
            , 'fecha_hasta'
            , 'titulo'));
        }else{
            $PDF = PDF::loadView('documentos.ingreso_grado_turno', compact('alumno'
            , 'turno_aux'
            , 'cobros'
            , 'grado_aux'
            , 'fecha_desde'
            , 'tipo_ingreso'
            , 'fecha_hasta'
            , 'titulo'));
        }

        return $PDF->stream();

    }


    public function ingreso_alumno(Request $request)
    {

        $search_cedula =str_replace('.', '', $request->cedula);
        $search_concepto = $request->ingreso_concepto;
        $search_desde_fecha = $request->desde_fecha;
        $fecha_desde =  date('Y-m-d', strtotime($search_desde_fecha));
        $search_hasta_fecha = $request->hasta_fecha;
        $fecha_hasta =  date('Y-m-d', strtotime($search_hasta_fecha));

        $alumno = Alumno::where('cedula', $search_cedula)
        ->first();

        if($search_concepto == 9999){
            $ingreso_hasta = 0;
            $titulo = 'TODOS';
        }else{
            $ingreso_hasta = $search_concepto;
            $aux_titulo = CobroIngresoConcepto::where('id', $search_concepto)
            ->first();
            $titulo = $aux_titulo->nombre;
        }

        $cobros = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
        ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
        ->where('cobro.cobro_concepto_id', 3)
        ->where('cobro.estado_id', 1)
        ->where('cobro_ingreso.alumno_id', $alumno->id)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$fecha_desde, $fecha_hasta])
        ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
        ->where('cobro_ingreso.cobro_ingreso_concepto', '>=', $ingreso_hasta)
        ->get();

        $tipo_ingreso = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
        ->select('cobro_ingreso.cobro_ingreso_concepto')
        ->distinct()
        ->where('cobro.cobro_concepto_id', 3)
        ->where('cobro.estado_id', 1)
        ->where('cobro_ingreso.alumno_id', $alumno->id)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$fecha_desde, $fecha_hasta])
        ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
        ->where('cobro_ingreso.cobro_ingreso_concepto', '>=', $ingreso_hasta)
        ->get();

        $PDF = PDF::loadView('documentos.ingreso_alumno', compact('alumno'
        , 'cobros'
        , 'fecha_desde'
        , 'tipo_ingreso'
        , 'fecha_hasta'
        , 'titulo'));

        return $PDF->stream();

    }

}
