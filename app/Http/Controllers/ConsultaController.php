<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\Cobro;
use App\Models\CobroIngreso;
use App\Models\CobroIngresoConcepto;
use App\Models\CobroMatricula;
use App\Models\CobroMatriculaCuota;
use App\Models\Grado;
use App\Models\Matricula;
use App\Models\Matricula_Cuota;
use App\Models\TipoCobro;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:consulta.index')->only('consulta.index');
        $this->middleware('permission:consulta.cobros_varios')->only('consulta.cobros_varios');
        $this->middleware('permission:consulta.cobros_varios_alumno')->only('consulta.cobros_varios_alumno');
        $this->middleware('permission:consulta.cobros_varios_grado')->only('consulta.cobros_varios_grado');
        $this->middleware('permission:consulta.cobros_cuota')->only('consulta.cobros_cuota');
        $this->middleware('permission:consulta.cobros_cuota_ver')->only('consulta.cobros_cuota_ver');
        $this->middleware('permission:consulta.grado_consulta')->only('consulta.grado_consulta');
        $this->middleware('permission:consulta.alumno_cuota_meses')->only('consulta.alumno_cuota_meses');
        $this->middleware('permission:consulta.ver_alumno_cuota_meses')->only('consulta.ver_alumno_cuota_meses');
    }

    public function index(Request $request)
    {

        $grado = Grado::all();
        $turno = Turno::all();
        $ciclo = Ciclo::all();
        $date = Carbon::now();
        $anio = date("Y",strtotime($date));
        $aux_ciclo = Ciclo::where('nombre', $anio)->first();
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

        if(!empty($request->ciclo)){
            $anio = $request->ciclo;
            $aux_ciclo = Ciclo::where('nombre', $anio)->first();
        }

        $alumno = Alumno::where('grado_id', $search_grado)
        ->where('turno_id', $search_turno)
        ->where('ciclo_id', $aux_ciclo->id)
        ->orderBy('apellido', 'ASC')
        ->orderBy('nombre', 'ASC')
        ->get();

        return view('consulta.index', compact('grado', 'turno', 'search_turno', 'search_grado', 'alumno', 'ciclo', 'anio'));

    }

    public function cobros_varios(Request $request)
    {
        $ingreso_concepto = CobroIngresoConcepto::where('estado_id', 1)->get();
        $tipo_cobro = TipoCobro::where('estado_id', 1)->get();
        $tipo_cobro_hasta = 0;
        $search_concepto_hasta = 0;

        if(empty($request->tipo_cobro)){
            $search_cobro = 999;
        }else{
            $search_cobro = $request->tipo_cobro;
            if($search_cobro != 999){
                $tipo_cobro_hasta = $request->tipo_cobro;
            }

        }

        if(empty($request->ingreso_concepto)){
            $search_concepto = 9999;
        }else{
            $search_concepto = $request->ingreso_concepto;
            if($search_concepto != 9999){
                $search_concepto_hasta = $request->ingreso_concepto;
            }
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

        $cobros = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
        ->join('alumno', 'cobro_ingreso.alumno_id', '=', 'alumno.id')
        ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id', 'alumno.nombre', 'alumno.apellido')
        ->where('cobro.cobro_concepto_id', 3)
        ->where('cobro.estado_id', 1)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
        ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
        ->where('cobro_ingreso.cobro_ingreso_concepto', '>=', $search_concepto_hasta)
        ->where('cobro.tipo_cobro_id', '<=', $search_cobro)
        ->where('cobro.tipo_cobro_id', '>=', $tipo_cobro_hasta)
        ->orderBy('alumno.apellido', 'ASC')
        ->orderBy('alumno.nombre', 'ASC')
        ->paginate(10);

        $cobros_aux = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
        ->join('alumno', 'cobro_ingreso.alumno_id', '=', 'alumno.id')
        ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id', 'alumno.nombre', 'alumno.apellido')
        ->where('cobro.cobro_concepto_id', 3)
        ->where('cobro.estado_id', 1)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
        ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
        ->where('cobro_ingreso.cobro_ingreso_concepto', '>=', $search_concepto_hasta)
        ->where('cobro.tipo_cobro_id', '<=', $search_cobro)
        ->where('cobro.tipo_cobro_id', '>=', $tipo_cobro_hasta)
        ->orderBy('alumno.apellido', 'ASC')
        ->orderBy('alumno.nombre', 'ASC')
        ->get();



        return view('consulta.cobros_varios', compact('ingreso_concepto'
        , 'search_concepto'
        , 'cobros'
        , 'cobros_aux'
        , 'tipo_cobro'
        , 'search_cobro'
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
        $search_concepto_hasta = 0;
        $unico = 0;
        $titulo = 'TODOS';

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

        if(empty($request->ingreso_concepto)){
            $search_concepto = 9999;
            $titulo = 'TODOS';
        }else{
            $search_concepto = $request->ingreso_concepto;
            if($search_concepto != 9999){
                $search_concepto_hasta = $request->ingreso_concepto;
                $aux_ingresos = CobroIngresoConcepto::where('id', $search_concepto)->first();
                $unico = $aux_ingresos->unico;
                if($unico == 1){
                    $search_desde_fecha =  date('Y-m-d', strtotime(date('Y', strtotime(Carbon::now())).'-01-01'));
                    $search_hasta_fecha =  date('Y-m-d', strtotime(date('Y', strtotime(Carbon::now())).'-12-31'));
                }
                $titulo = $aux_ingresos->nombre;
            }
        }

        $cobros = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
        ->join('alumno', 'cobro_ingreso.alumno_id', '=', 'alumno.id')
        ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id', 'alumno.grado_id', 'alumno.turno_id', 'alumno.nombre', 'alumno.apellido')
        ->where('cobro.cobro_concepto_id', 3)
        ->where('cobro.estado_id', 1)
        ->where('cobro.grado_id', $search_grado)
        ->where('cobro.turno_id', $search_turno)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
        ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
        ->where('cobro_ingreso.cobro_ingreso_concepto', '>=', $search_concepto_hasta)
        ->orderBy('alumno.nombre', 'ASC')
        ->paginate(10);

        $cobros_aux = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
        ->join('alumno', 'cobro_ingreso.alumno_id', '=', 'alumno.id')
        ->select('cobro_ingreso.*', 'cobro.fecha_cobro', 'cobro.estado_id', 'alumno.grado_id', 'alumno.turno_id', 'alumno.nombre', 'alumno.apellido')
        ->where('cobro.cobro_concepto_id', 3)
        ->where('cobro.estado_id', 1)
        ->where('cobro.grado_id', $search_grado)
        ->where('cobro.turno_id', $search_turno)
        ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$search_desde_fecha, $search_hasta_fecha])
        ->where('cobro_ingreso.cobro_ingreso_concepto', '<=', $search_concepto)
        ->where('cobro_ingreso.cobro_ingreso_concepto', '>=', $search_concepto_hasta)
        ->orderBy('alumno.apellido', 'ASC')
        ->orderBy('alumno.nombre', 'ASC')
        ->get();

        $alumno = Alumno::where('turno_id', $search_turno)
        ->where('grado_id', $search_grado)
        ->where('estado_id', 1)
        ->orderBy('apellido', 'ASC')
        ->orderBy('nombre', 'ASC')
        ->get();


        return view('consulta.cobros_varios_grado', compact('ingreso_concepto'
        , 'search_concepto'
        , 'grado'
        , 'turno'
        , 'cobros'
        , 'unico'
        , 'titulo'
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
        $tipo_cobro = TipoCobro::where('estado_id', 1)->get();
        $search_grado = 1;
        $search_turno = 1;
        $search_cobro_hasta = 0;
        $busqueda = 1;
        $ver = 0;

        return view('consulta.cobros_cuota', compact('ver'));
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

    public function grado_consulta(Request $request)
    {
        $search_grado = 0;
        $search_turno = 0;
        $search_mes = 2;
        $date = Carbon::now();
        $anio = date("Y",strtotime($date));
        $aux_ciclo = Ciclo::where('nombre', $anio)->first();
        if(!empty($request->grado)){
            $search_grado = $request->grado;
        }

        if(!empty($request->turno)){
            $search_turno = $request->turno;
        }

        if(!empty($request->mes)){
            $search_mes = $request->mes;
        }

        if(!empty($request->ciclo)){
            $anio = $request->ciclo;
            $aux_ciclo = Ciclo::where('nombre', $anio)->first();
        }


        $grado = Grado::where('estado_id', 1)->get();
        $turno = Turno::where('estado_id', 1)->get();
        $ciclo = Ciclo::all();

        $alumno = Alumno::where('grado_id', $search_grado)
        ->where('turno_id', $search_turno)
        ->where('ciclo_id', $aux_ciclo->id)
        ->where('estado_id', 1)
        ->orderBy('apellido', 'ASC')
        ->orderBy('nombre', 'ASC')
        ->get();

        $cobros = Matricula_Cuota::join('matricula', 'matricula_cuotas.matricula_id', '=', 'matricula.id')
        ->select('matricula_cuotas.*', 'matricula.ciclo_id', 'matricula.alumno_id')
        ->where(DB::raw('MONTH(matricula_cuotas.fecha_vencimiento)'), $search_mes)
        ->where('matricula.ciclo_id', $aux_ciclo->id)
        ->where('matricula_cuotas.estado_id', 1)
        ->get();

        return view('consulta.cobro_grado_cuota', compact('grado'
        , 'turno'
        , 'search_grado'
        , 'ciclo'
        , 'alumno'
        , 'cobros'
        , 'anio'
        , 'search_turno'
        , 'search_mes'));
    }

    public function alumno_cuota_meses(Request $request){

        $ver = 0;
        $grado = Grado::where('estado_id', 1)->get();
        $turno = Turno::where('estado_id', 1)->get();
        $search_grado = 0;
        $search_turno = 0;
        if(!empty($request->turno)){
            $search_turno = $request->turno;
        }

        if(!empty($request->grado)){
            $search_grado = $request->grado;
        }

        if(!empty($request->checkeado)){
            $ver = $request->checkeado;
        }

        $date = Carbon::now();
        $ciclo = Ciclo::where('nombre', date("Y",strtotime($date)))->first();

        $alumnos = Alumno::where('grado_id', $search_grado)
        ->where('turno_id', $search_turno)
        ->where('ciclo_id', $ciclo->id)
        ->where('estado_id', 1)
        ->orderBy('apellido', 'ASC')
        ->orderBy('nombre', 'ASC')
        ->get();

        $matriculas = Matricula::where('ciclo_id', $ciclo->id)
        ->where('estado_id' , 1)
        ->where('grado_id', $search_grado)
        ->where('turno_id', $search_turno)
        ->get();

        return view('consulta.alumno_cuota_meses', compact('ver'
        , 'grado'
        , 'search_grado'
        , 'alumnos'
        , 'matriculas'
        , 'ver'
        , 'search_turno'
        , 'turno'));
    }

    public function ver_alumno_cuota_meses(Alumno $alumno){
        $date = Carbon::now();
        $ciclo = Ciclo::where('nombre', date("Y",strtotime($date)))->first();
        $matricula = Matricula::where('alumno_id', $alumno->id)
        ->where('ciclo_id', $ciclo->id)
        ->where('estado_id' , 1)
        ->first();

        if(empty($matricula)){
            return redirect()->route('consulta.alumno_cuota_meses')
            ->withInput()
            ->withErrors('El alumno no esta matriculado!.');
        }


        return view('consulta.ver_alumno_cuota_meses', compact('alumno', 'matricula'));
    }

}
