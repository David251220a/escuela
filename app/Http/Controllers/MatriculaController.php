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

    public function __construct()
    {
        $this->middleware('permission:matricula.index')->only('index');
        $this->middleware('permission:matricula.create')->only('create');
        $this->middleware('permission:matricula.store')->only('store');
        $this->middleware('permission:matricula.show')->only('show');
        $this->middleware('permission:matricula.edit')->only('edit');
        $this->middleware('permission:matricula.update')->only('update');
        $this->middleware('permission:matricula.cobro')->only('matricula.cobro');
        $this->middleware('permission:matricula.buscar_alumno')->only('matricula.buscar_alumno');
    }

    public function index(Request $request)
    {
        return view('matricula.index');
    }

    public function create(Request $request)
    {
        $ciclo = Ciclo::where('estado_id', 1)
        ->get();
        $grado = Grado::where('estado_id', 1)
        ->get();
        $turno = Turno::where('estado_id', 1)
        ->get();
        $tipo_cobro = TipoCobro::where('estado_id', 1)
        ->get();

        $alumno = Alumno::find($request->id);

        $existe = Matricula::where('alumno_id', $alumno->id)
        ->where('estado_id', 1)
        ->where('ciclo_id', $ciclo[0]->id)
        ->first();

        if(!empty($existe)){
            return redirect()->route('alumno.index')
            ->withInput()
            ->withErrors('Ya existe matriculacion para este alumno en este ciclo.');
        }

        return view('matricula.create', compact('ciclo', 'grado', 'turno', 'tipo_cobro', 'alumno'));
    }

    public function store(MatriculaRequest $request)
    {
        $cedula = str_replace('.', '', $request->cedula);
        $monto_matricula = str_replace('.', '', $request->matricula);
        $monto_cuota = str_replace('.', '', $request->monto_cuota);
        $cuota = $request->cant_cuota;
        $date = Carbon::now();
        $alumno = Alumno::where('cedula', $cedula)
        ->first();

        $existe = Matricula::where('alumno_id', $alumno->id)
        ->where('estado_id', 1)
        ->where('ciclo_id', $request->ciclo)
        ->first();

        if(!empty($existe)){
            return redirect()->route('matricula.create')
            ->withInput()
            ->withErrors('Ya existe matriculacion para este alumno en este ciclo.');
        }

        $fecha = Carbon::now();

        if(empty($alumno)){
            return redirect()->route('matricula.create')
            ->withInput()
            ->withErrors('No existe alumno con este nro. de cedula: ' .$cedula);
        }

        $matricula = Matricula::create([
            'alumno_id' => $alumno->id,
            'ciclo_id' => $request->ciclo,
            'grado_id' => $request->grado,
            'turno_id' => $request->turno,
            'estado_id' => 1,
            'fecha' => $date,
            'monto_matricula' => $monto_matricula,
            'matricula_estado_id' => 1,
            'monto_cuota' => $monto_cuota,
            'fecha_inicio' => date_format(date_create($request->fecha_cuota[0]), "Y-m-d"),
            'usuario_alta' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
            'cantidad_cuota' => $request->cantidad_cuota,
        ]);

        for ($i=0; $i < $request->cantidad_cuota; $i++) {

            $matricula->cuotas()->create([
                'cuota' => $cuota[$i],
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

        $alumno->grado_id = $request->grado;
        $alumno->turno_id = $request->turno;
        $alumno->ciclo_id = $request->ciclo;
        $alumno->update();

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

    public function update(Request  $request, Matricula $matricula)
    {
        // dd($request->all());
        $cuota_selecionada = $request->cuota_seleccionada;
        $fecha = Carbon::now();
        $total_pagar = str_replace('.', '', $request->total_pagar);
        $total_cobrar = str_replace('.', '', $request->total_cobrar);
        $matricula_cobrar = str_replace('.', '', $request->matricula_cobrar);
        $monto_matricula = str_replace('.', '', $request->monto_matricula);
        $aplica_multa = $request->aplica_multa;

        if($matricula_cobrar > 0){

            if($matricula_cobrar > $monto_matricula){
                return redirect()->route('matricula.show', $matricula)
                ->withInput()
                ->withErrors('El Total Matricula a Pagar no puede ser mayor al monto matricula!.');
            }

            $cobro = Cobro::create([
                'caja_id' => 1,
                'sede_id' => 1,
                'fecha_cobro' => $fecha,
                'estado_id' => 1,
                'cobro_concepto_id' => 1,
                'total_cobrado' => $matricula_cobrar,
                'observacion' => 'COBRO DE MATRICULA',
                'tipo_cobro_id' => $request->tipo_cobro,
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
                'monto_saldo_factura' => ($matricula->monto_matricula - $matricula_cobrar),
                'monto_cobrado_factura' => $matricula_cobrar,
                'matricula_id' => $matricula->id,
                'estado_id' => 1,
                'usuario_alta' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);

        }else{
            if($total_pagar > $total_cobrar){
                return redirect()->route('matricula.show', $matricula)
                ->withInput()
                ->withErrors('El Total a Pagar no puede ser mayor a lo cobrado!.');
            }

            if($total_cobrar == 0){
                return redirect()->route('matricula.show', $matricula)
                ->withInput()
                ->withErrors('Debe seleccionar una cuota!!.');
            }

            $cobro = Cobro::create([
                'caja_id' => 1,
                'sede_id' => 1,
                'fecha_cobro' => $fecha,
                'estado_id' => 1,
                'cobro_concepto_id' => 2,
                'total_cobrado' => $total_pagar,
                'observacion' => 'COBRO DE MATRICULA - CUOTA',
                'tipo_cobro_id' => $request->tipo_cobro,
                'salida_id' => 1,
                'recibo_id' => 1,
                'usuario_alta' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);

            for ($i=0; $i < count($cuota_selecionada); $i++) {
                if($total_pagar <= 0){
                    break;
                }
                if($cuota_selecionada[$i] == 1){
                    $cobrar_multa = 0;
                    $multa = str_replace('.', '', $request->multa);
                    $monto_cuota = $request->cuota_cobrar[$i];
                    $monto_cuota_saldo = str_replace('.', '', $request->cuota_saldo[$i]);
                    $monto_cuota_cobrado = str_replace('.', '', $request->cuota_cobrado[$i]);
                    $matricula_cuota_id = $request->cuota[$i];

                    if($aplica_multa[$i] == 0){
                        $multa = 0;
                        $cobrar_multa = 0;
                    }else{
                        if($multa <= $total_pagar){
                            $cobrar_multa = 1;
                        }else{
                            $cobrar_multa = 0;
                            $multa = 0;
                        }
                    }

                    if($cobrar_multa == 0){
                        $monto_cuota_real = $monto_cuota - $monto_cuota_cobrado;
                        if($total_pagar >= $monto_cuota_real){
                            $monto_total_pagar = $monto_cuota_real;
                        }else{
                            $monto_total_pagar = $total_pagar;
                        }
                    }else{
                        $aux_total_pagar = 0;
                        $aux_total_pagar = $total_pagar;
                        $aux_total_pagar = $aux_total_pagar - $multa;
                        $monto_cuota_real = $monto_cuota - $monto_cuota_cobrado;
                        if($aux_total_pagar <= 0){
                            $monto_total_pagar = 0;
                        }else{
                            if($aux_total_pagar >= $monto_cuota_real){
                                $monto_total_pagar = $monto_cuota_real;
                            }else{
                                $monto_total_pagar = $aux_total_pagar;
                            }
                        }

                    }


                    if($total_pagar > 0){
                        $cobro->cobro_matricula_cuota()->create([
                            'factura_sucursal' => '000',
                            'factura_general' => '000',
                            'factura_nro' => '000000',
                            'monto_total_cuota' => $monto_cuota_real,
                            'monto_saldo_cuota' => $monto_cuota_real - $monto_total_pagar,
                            'monto_cobrado_cuota' => $monto_total_pagar,
                            'matricula_cuota_id' => $matricula_cuota_id,
                            'matricula_id' => $matricula->id,
                            'monto_multa_a_cobrar' => $multa,
                            'monto_multa_a_cobrado' => $multa,
                            'estado_id' => 1,
                            'usuario_alta' => auth()->user()->id,
                            'usuario_modificacion' => auth()->user()->id,
                        ]);


                        $matricula_cuota = Matricula_Cuota::where('id', $matricula_cuota_id)
                        ->first();

                        $max_cuota = Matricula_Cuota::where('matricula_id', $matricula->id)
                        ->max('cuota');

                        if($max_cuota == $matricula_cuota->cuota){
                            $matricula_cuota->matricula->update([
                                'matricula_estado_id' => 2,
                                'usuario_modificacion' => auth()->user()->id,
                                'updated_at' => $fecha,
                            ]);
                        }

                        $matricula_cuota->update([
                            'monto_cuota_cobrado' => $matricula_cuota->monto_cuota_cobrado + $monto_total_pagar,
                            'monto_cobrado' => $matricula_cuota->monto_cuota_cobrado + $monto_total_pagar + $matricula_cuota->monto_multa_cobrado + $multa,
                            'saldo' => $monto_cuota_real - $monto_total_pagar,
                            'monto_multa_cobrar' => $matricula_cuota->monto_multa_cobrar + $multa,
                            'monto_multa_cobrado' => $matricula_cuota->monto_multa_cobrado + $multa,
                            'total_cuota' => $matricula_cuota->monto_cuota_cobrar + $matricula_cuota->monto_multa_cobrado + $multa,
                            'usuario_modificacion' => auth()->user()->id,
                            'updated_at' => $fecha,
                        ]);

                    }


                    if($total_pagar >= ($total_pagar - ($monto_cuota_real + $multa))){
                        $total_pagar = ($total_pagar - ($monto_cuota_real + $multa));
                    }else{
                        $total_pagar = 0;
                    }
                }
            }
        }

        return redirect()->route('matricula.show', $matricula)->with('message', 'Cobro Realizado con exito!!.');

    }

    public function cobros(Request $request, $id)
    {
        $fecha = Carbon::now();
        $fecha = date('Y', strtotime($fecha));

        $ciclo = Ciclo::where('año', $fecha)
        ->first();

        $matricula = Matricula::where('alumno_id', $id)
        ->where('estado_id', 1)
        ->where('ciclo_id', $ciclo->id)
        ->first();

        if(empty($matricula)){
            return redirect()->route('alumno.index')
            ->withInput()
            ->withErrors('Todavia no se ha matroculado al alumno en este ciclo: ' .$fecha);
        }

        $matricula_cuota = Matricula_Cuota::where('matricula_id', $matricula->id)
        ->where('estado_id', 1)
        ->get();

        $paramentro_general = ParametroGeneral::first();
        $tipo_cobro = TipoCobro::where('estado_id', 1)
        ->get();


        return view('matricula.cobros', compact('matricula', 'matricula_cuota', 'paramentro_general', 'tipo_cobro'));
    }

}
