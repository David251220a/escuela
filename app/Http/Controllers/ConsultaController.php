<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Cobro;
use App\Models\CobroIngreso;
use App\Models\CobroIngresoConcepto;
use App\Models\Grado;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function cobros_varios(Request $request)
    {
        $ingreso_concepto = CobroIngresoConcepto::where('estado_id', 1)
        ->get();
        if(empty($request->ingreso_concepto)){
            $search_concepto = 9999;
        }else{
            $search_concepto = $request->ingreso_concepto;
        }

        if(empty($request->desde_fecha)){
            $search_desde_fecha =  date('Y-m-d', strtotime(Carbon::now()));
        }else{
            $search_desde_fecha = $request->desde_fecha;
            $search_desde_fecha =  date('Y-m-d', strtotime($search_desde_fecha));
        }

        if(empty($request->hasta_fecha)){
            $search_hasta_fecha =  date('Y-m-d', strtotime(Carbon::now()));
        }else{
            $search_hasta_fecha = $request->hasta_fecha;
            $search_hasta_fecha =  date('Y-m-d', strtotime($search_hasta_fecha));
        }

        if($search_concepto == 9999){
            $cobros = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
            ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
            ->where('cobro.cobro_concepto_id', 3)
            ->where('cobro.estado_id', 1)
            ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
            ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
            ->paginate(10);

            $cobros_aux = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
            ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
            ->where('cobro.cobro_concepto_id', 3)
            ->where('cobro.estado_id', 1)
            ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
            ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
            ->get();

        }else{
            $cobros = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
            ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
            ->where('cobro.cobro_concepto_id', 3)
            ->where('cobro.estado_id', 1)
            ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
            ->where('cobro_ingreso.cobro_ingreso_concepto', $search_concepto)
            ->paginate(10);

            $cobros_aux = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
            ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
            ->where('cobro.cobro_concepto_id', 3)
            ->where('cobro.estado_id', 1)
            ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
            ->where('cobro_ingreso.cobro_ingreso_concepto', $search_concepto)
            ->get();
        }


        return view('consulta.cobros_varios', compact('ingreso_concepto'
        , 'search_concepto'
        , 'cobros'
        , 'cobros_aux'
        , 'search_desde_fecha'
        , 'search_hasta_fecha'));
    }

    public function cobros_varios_alumno(Request $request)
    {

        $ingreso_concepto = CobroIngresoConcepto::where('estado_id', 1)
        ->get();
        if((empty($request->cedula)) || ($request->cedula == 0)) {
            $search_cedula = 0;
        }else{
            $search_cedula =str_replace('.', '', $request->cedula);
        }

        if(empty($request->ingreso_concepto)){
            $search_concepto = 9999;
        }else{
            $search_concepto = $request->ingreso_concepto;
        }

        if(empty($request->desde_fecha)){
            $search_desde_fecha =  date('Y-m-d', strtotime(Carbon::now()));
        }else{
            $search_desde_fecha = $request->desde_fecha;
            $search_desde_fecha =  date('Y-m-d', strtotime($search_desde_fecha));
        }

        if(empty($request->hasta_fecha)){
            $search_hasta_fecha =  date('Y-m-d', strtotime(Carbon::now()));
        }else{
            $search_hasta_fecha = $request->hasta_fecha;
            $search_hasta_fecha =  date('Y-m-d', strtotime($search_hasta_fecha));
        }

        $alumno = Alumno::where('cedula', $search_cedula)
        ->first();

        $cobros='';
        $cobros_aux='';

        if($search_concepto == 9999){
            if(!empty($alumno)){
                $cobros = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
                ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
                ->where('cobro.cobro_concepto_id', 3)
                ->where('cobro.estado_id', 1)
                ->where('alumno_id', $alumno->id)
                ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
                ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
                ->paginate(10);

                $cobros_aux = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
                ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
                ->where('cobro.cobro_concepto_id', 3)
                ->where('cobro.estado_id', 1)
                ->where('alumno_id', $alumno->id)
                ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
                ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
                ->get();
            }

        }else{
            if(!empty($alumno)){
                $cobros = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
                ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
                ->where('cobro.cobro_concepto_id', 3)
                ->where('cobro.estado_id', 1)
                ->where('alumno_id', $alumno->id)
                ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
                ->where('cobro_ingreso.cobro_ingreso_concepto', $search_concepto)
                ->paginate(10);

                $cobros_aux = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
                ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
                ->where('cobro.cobro_concepto_id', 3)
                ->where('cobro.estado_id', 1)
                ->where('alumno_id', $alumno->id)
                ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
                ->where('cobro_ingreso.cobro_ingreso_concepto', $search_concepto)
                ->get();
            }
        }


        return view('consulta.cobros_varios_alumno', compact('ingreso_concepto'
        , 'search_concepto'
        , 'cobros'
        , 'alumno'
        , 'cobros_aux'
        , 'search_cedula'
        , 'search_desde_fecha'
        , 'search_hasta_fecha'));

    }

}
