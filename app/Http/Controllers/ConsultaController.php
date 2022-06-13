<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\Cobro;
use App\Models\CobroIngreso;
use App\Models\CobroIngresoConcepto;
use App\Models\CobroMatriculaCuota;
use App\Models\Grado;
use App\Models\Matricula;
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
                ->where('cobro_ingreso.alumno_id', $alumno->id)
                ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
                ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
                ->paginate(10);

                $cobros_aux = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
                ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id')
                ->where('cobro.cobro_concepto_id', 3)
                ->where('cobro.estado_id', 1)
                ->where('cobro_ingreso.alumno_id', $alumno->id)
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
                ->where('cobro_ingreso.alumno_id', $alumno->id)
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

    public function cobros_varios_grado(Request $request)
    {
        $ingreso_concepto = CobroIngresoConcepto::where('estado_id', 1)
        ->get();
        $grado = Grado::where('estado_id', 1)->get();
        $turno = Turno::where('estado_id', 1)->get();
        $search_grado = 1;
        $search_turno = 1;

        if(!empty($request->grado)){
            $search_grado = $request->grado;
        }

        if(!empty($request->turno)){
            $search_turno = $request->turno;
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

        $alumno = Alumno::all();

        return view('consulta.cobros_varios_grado', compact('ingreso_concepto'
        , 'search_concepto'
        , 'grado'
        , 'turno'
        , 'cobros'
        , 'alumno'
        , 'cobros_aux'
        , 'search_grado'
        , 'search_turno'
        , 'search_desde_fecha'
        , 'search_hasta_fecha'));
    }

    public function cobros_cuota(Request $request)
    {
        $grado = Grado::where('estado_id', 1)->get();
        $turno = Turno::where('estado_id', 1)->get();
        $search_grado = 1;
        $search_turno = 1;

        if(!empty($request->grado)){
            $search_grado = $request->grado;
        }

        if(!empty($request->turno)){
            $search_turno = $request->turno;
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

        $ver = 0;
        if(empty($request->checkeado)){
            $ver = 0;
        }else{
            $ver = $request->checkeado;
        }

        $cobros = CobroMatriculaCuota::join('matricula', 'cobro_matricula_cuota.matricula_id', '=', 'matricula.id')
        ->join('cobro', 'cobro_matricula_cuota.cobro_id', '=', 'cobro.id')
        ->select('cobro_matricula_cuota.*', 'cobro.fecha_cobro', 'matricula.grado_id','matricula.turno_id')
        ->where('cobro.estado_id', 1)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
        ->where('matricula.turno_id', $search_turno)
        ->where('matricula.grado_id', $search_grado)
        ->paginate(10);

        $cobros_aux = CobroMatriculaCuota::join('matricula', 'cobro_matricula_cuota.matricula_id', '=', 'matricula.id')
        ->join('cobro', 'cobro_matricula_cuota.cobro_id', '=', 'cobro.id')
        ->select('cobro_matricula_cuota.*', 'cobro.fecha_cobro', 'matricula.grado_id','matricula.turno_id')
        ->where('cobro.estado_id', 1)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
        ->where('matricula.turno_id', $search_turno)
        ->where('matricula.grado_id', $search_grado)
        ->get();

        return view('consulta.cobros_cuota', compact(
        'grado'
        , 'turno'
        , 'ver'
        , 'cobros'
        , 'cobros_aux'
        , 'search_grado'
        , 'search_turno'
        , 'search_desde_fecha'
        , 'search_hasta_fecha'));
    }


    public function cobros_cuota_ver($id)
    {
        $alumno = Alumno::find($id);

        $fecha = Carbon::now();
        $fecha = date('Y', strtotime($fecha));

        $ciclo = Ciclo::where('año', $fecha)
        ->first();

        $matricula = Matricula::where('alumno_id', $id)
        ->where('estado_id', 1)
        ->where('ciclo_id', $ciclo->id)
        ->first();

        if(empty($matricula)){
            return redirect()->route('consulta.cobros_cuota')
            ->withInput()
            ->withErrors('Todavia no se ha matroculado al alumno en este ciclo: ' .$fecha);
        }

        return view('consulta.cobros_cuota_ver', compact('alumno'));
    }
}
