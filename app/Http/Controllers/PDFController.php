<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\CobroIngreso;
use App\Models\CobroIngresoConcepto;
use App\Models\CobroMatricula;
use App\Models\CobroMatriculaCuota;
use App\Models\Grado;
use App\Models\Matricula;
use App\Models\Matricula_Cuota;
use App\Models\Turno;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
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
        $todos = 1;

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
            $todos = 0;
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

        if($ingreso == 9999){
            $PDF = PDF::loadView('documentos.ingreso_grado_turno', compact('alumno'
            , 'turno_aux'
            , 'cobros'
            , 'grado_aux'
            , 'fecha_desde'
            , 'tipo_ingreso'
            , 'fecha_hasta'
            , 'titulo'));
        }else{
            if($aux_titulo->unico == 1) {
                $PDF = PDF::loadView('documentos.derecho_examen', compact('alumno'
                , 'turno_aux'
                , 'cobros'
                , 'grado_aux'
                , 'aux_titulo'
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


    public function imprimir_cobro_matricula($id)
    {
        $matricula = Matricula::find($id);
        $formatter = new NumeroALetras();
        $PDF = PDF::loadView('documentos.comprobante_cobro_matricula', compact('matricula', 'formatter'));

        return $PDF->stream();

    }

    public function ingreso_varios(Request $request)
    {

        $tipo_cobro_hasta = 0;
        $search_concepto_hasta = 0;

        $search_cobro = $request->search_cobro;
        if($search_cobro != 999){
            $tipo_cobro_hasta = $request->search_cobro;
        }

        $search_concepto = $request->search_concepto;
        if($search_concepto != 9999){
            $search_concepto_hasta = $request->search_concepto;
        }

        $search_desde_fecha = $request->search_desde_fecha;
        $search_desde_fecha =  date('Y-m-d', strtotime($search_desde_fecha));

        $search_hasta_fecha = $request->search_hasta_fecha;
        $search_hasta_fecha =  date('Y-m-d', strtotime($search_hasta_fecha));


        $cobros = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
        ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
        ->where('cobro.cobro_concepto_id', 3)
        ->where('cobro.estado_id', 1)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
        ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
        ->where('cobro_ingreso.cobro_ingreso_concepto', '>=', $search_concepto_hasta)
        ->where('cobro.tipo_cobro_id', '<=', $search_cobro)
        ->where('cobro.tipo_cobro_id', '>=', $tipo_cobro_hasta)
        ->orderBy('cobro_ingreso.cobro_ingreso_concepto', 'ASC')
        ->orderBy('cobro.tipo_cobro_id', 'ASC')
        ->get();

        $PDF = PDF::loadView('documentos.ingresos_varios', compact('cobros', 'search_desde_fecha', 'search_hasta_fecha'));

        return $PDF->stream();
    }

    public function ingreso_cuota(Request $request)
    {
        $search_cobro_hasta = 0;
        $search_cobro = $request->search_cobro;
        if($search_cobro != 999){
            $search_cobro_hasta = $request->search_cobro;
        }

        $search_grado = $request->search_grado;
        $search_turno = $request->search_turno;
        $search_desde_fecha = $request->search_desde_fecha;
        $search_desde_fecha =  date('Y-m-d', strtotime($search_desde_fecha));
        $search_hasta_fecha = $request->search_hasta_fecha;
        $search_hasta_fecha =  date('Y-m-d', strtotime($search_hasta_fecha));

        $grado = Grado::find($search_grado);
        $turno = Turno::find($search_turno);

        $cobros = CobroMatriculaCuota::join('matricula', 'cobro_matricula_cuota.matricula_id', '=', 'matricula.id')
        ->join('cobro', 'cobro_matricula_cuota.cobro_id', '=', 'cobro.id')
        ->select('cobro_matricula_cuota.*', 'cobro.fecha_cobro', 'matricula.grado_id','matricula.turno_id')
        ->where('cobro.estado_id', 1)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
        ->where('matricula.turno_id', $search_turno)
        ->where('matricula.grado_id', $search_grado)
        ->where('cobro.tipo_cobro_id', '<=', $search_cobro)
        ->where('cobro.tipo_cobro_id', '>=', $search_cobro_hasta)
        ->orderBy('cobro.fecha_cobro', 'DESC')
        ->get();

        $PDF = PDF::loadView('documentos.ingresos_cuota', compact('cobros', 'search_desde_fecha', 'search_hasta_fecha', 'grado', 'turno'));

        return $PDF->stream();

    }

    public function ingreso_matricula(Request $request)
    {
        $search_cobro_hasta = 0;
        $search_cobro = $request->search_cobro;
        if($search_cobro != 999){
            $search_cobro_hasta = $request->search_cobro;
        }

        $search_grado = $request->search_grado;
        $search_turno = $request->search_turno;
        $search_desde_fecha = $request->search_desde_fecha;
        $search_desde_fecha =  date('Y-m-d', strtotime($search_desde_fecha));
        $search_hasta_fecha = $request->search_hasta_fecha;
        $search_hasta_fecha =  date('Y-m-d', strtotime($search_hasta_fecha));

        $grado = Grado::find($search_grado);
        $turno = Turno::find($search_turno);

        $cobros = CobroMatricula::join('matricula', 'cobro_matricula.matricula_id', '=', 'matricula.id')
        ->join('cobro', 'cobro_matricula.cobro_id', '=', 'cobro.id')
        ->where('cobro.estado_id', 1)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
        ->where('matricula.turno_id', $search_turno)
        ->where('matricula.grado_id', $search_grado)
        ->where('cobro.tipo_cobro_id', '<=', $search_cobro)
        ->where('cobro.tipo_cobro_id', '>=', $search_cobro_hasta)
        ->orderBy('cobro.fecha_cobro', 'DESC')
        ->get();

        $PDF = PDF::loadView('documentos.ingresos_matricula', compact('cobros', 'search_desde_fecha', 'search_hasta_fecha', 'grado', 'turno'));

        return $PDF->stream();
    }

    public function estado_cuenta($id)
    {
        $date = Carbon::now();
        $anio = date('Y', strtotime($date));
        $alumno = Alumno::find($id);
        $ciclo = Ciclo::where('año', $anio)->first();
        $matricula = Matricula::where('alumno_id', $id)
        ->where('ciclo_id', $ciclo->id)
        ->orderBy('id', 'DESC')
        ->first();

        $cobro_matricula = CobroMatricula::where('matricula_id', $matricula->id)
        ->where('estado_id', 1)
        ->get();
        $cobro_matricula_cuota = CobroMatriculaCuota::where('matricula_id', $matricula->id)->where('estado_id', 1)->get();
        $cobro_ingreso = CobroIngreso::where('alumno_id', $alumno->id)->where('estado_id', 1)->whereYear('created_at', $anio)->get();

        $PDF = PDF::loadView('documentos.estado_cuenta', compact('alumno', 'ciclo', 'cobro_matricula', 'cobro_matricula_cuota', 'matricula', 'cobro_ingreso'));

        return $PDF->stream();
    }
}
