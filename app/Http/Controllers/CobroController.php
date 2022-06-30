<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\Cobro;
use App\Models\CobroIngreso;
use App\Models\CobroIngresoConcepto;
use App\Models\TipoCobro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\DB;

class CobroController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ingreso.cobro')->only('ingreso.cobro');
        $this->middleware('permission:ingreso.store')->only('ingreso.store');
        $this->middleware('permission:ingreso.nuevo_ingreso')->only('ingreso.nuevo_ingreso');
        $this->middleware('permission:ingreso.cobros_pendientes')->only('ingreso.cobros_pendientes');
        $this->middleware('permission:ingreso.cobros_pendientes_detalle')->only('ingreso.cobros_pendientes_detalle');
        $this->middleware('permission:ingreso.cobros_pendientes_detalle_store')->only('ingreso.cobros_pendientes_detalle_store');
        $this->middleware('permission:ingreso.cobros_pendientes_detalle_imprimir')->only('ingreso.cobros_pendientes_detalle_imprimir');
    }

    public function cobros_varios(Request $request, $id)
    {
        $alumno = Alumno::find($id);
        $ingreso_concepto = CobroIngresoConcepto::where('estado_id', 1)
        ->get();

        $tipo_cobro = TipoCobro::all();

        return view('cobro.cobro', compact('ingreso_concepto', 'alumno', 'tipo_cobro'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'cedula' => 'required',
            'total_ingresoss' => 'required',
            'total_pagar_completo' => 'required'
        ]);

        $total_pagar = str_replace('.', '', $request->total_pagar_completo);
        $total_ingresos = str_replace('.', '', $request->total_ingresoss);
        $pago_parcial = 2;

        if($total_pagar <= 0){
            return redirect()->route('ingreso.cobro', $id)
            ->withInput()
            ->withErrors('El monto total a pagar no puede ser menor o igual a cero.!');
        }

        if($total_ingresos <= 0){
            return redirect()->route('ingreso.cobro', $id)
            ->withInput()
            ->withErrors('El monto total a cobrar no puede ser menor o igual a cero.!');
        }

        if($total_ingresos < $total_pagar){
            return redirect()->route('ingreso.cobro', $id)
            ->withInput()
            ->withErrors('El monto total a pagar no puede ser mayor a cobrar.!');
        }

        $fecha = Carbon::now();
        $alumno = Alumno::find($id);
        if(empty($alumno)){
            return redirect()->route('alumno.index')
            ->withInput()
            ->withErrors('No Exite Alumno con este numero de documento!');
        }

        if($total_ingresos > $total_pagar){
            $pago_parcial = 1;
        }

        $tipo_cobro = $request->tipo_cobro;
        $precio = $request->precio_aux;
        $cantidad = $request->cantidad_aux;
        $id_concepto = $request->id_concepto;
        $monto_ingreso = $request->total_ingreso_aux;

        $date = Carbon::now();
        $ciclo = Ciclo::where('nombre', date("Y",strtotime($date)))->first();
        // dd($request->all());
        $anio = date("Y",strtotime($date));
        $aux_ciclo = Ciclo::where('nombre', $anio)->first();

        $cobro = Cobro::create([
            'caja_id' => 1,
            'sede_id' => 1,
            'fecha_cobro' => $fecha,
            'estado_id' => 1,
            'cobro_concepto_id' => 3,
            'total_cobrado' => $total_pagar,
            'observacion' => 'INGRESO VARIOS',
            'tipo_cobro_id' => $tipo_cobro,
            'salida_id' => 1,
            'recibo_id' => 1,
            'usuario_alta' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
            'alumno_id' => $alumno->id,
            'grado_id' => $alumno->grado->id,
            'turno_id' => $alumno->turno->id,
            'ciclo_id' => $alumno->ciclo->id,
        ]);

        for ($i=0; $i < count($id_concepto); $i++) {

            $validar_unico = CobroIngreso::where('cobro_ingreso_concepto', $id_concepto[$i])
            ->where('ciclo_id', $aux_ciclo->id)
            ->where('estado_id', 1)
            ->where('alumno_id', $alumno->id)
            ->where('padre_ingreso_id', 0)
            ->first();

            if(!empty($validar_unico)){
                if($validar_unico->ingreso_concepto->unico == 1){
                    $eliminar_cobro_ingreso = CobroIngreso::where('cobro_id', $cobro->id)
                    ->get();
                    if(!empty($eliminar_cobro_ingreso)){
                        foreach($eliminar_cobro_ingreso as $eliminar){
                            $eliminar->delete();
                        }
                    }
                    $cobro->delete();
                    return redirect()->route('ingreso.cobro', $id)
                    ->withInput()
                    ->withErrors('Ya existe un pago de este ingreso unico. En Fecha : '. date('d/m/Y', strtotime($validar_unico->cobros->fecha_cobro)));
                }
            }

            if($pago_parcial == 2){
                $pagado = str_replace('.', '', $monto_ingreso[$i]);
                $saldo = 0;
            }else{
                if($total_pagar > 0){
                    $aux_ingre = str_replace('.', '', $monto_ingreso[$i]);
                    if($aux_ingre > $total_pagar){
                        $pagado = $total_pagar;
                        $saldo = $aux_ingre - $total_pagar;
                    }

                    if($aux_ingre == $total_pagar){
                        $pagado = $total_pagar;
                        $saldo = 0;
                    }

                    if($total_pagar > $aux_ingre){
                        $pagado = $aux_ingre;
                        $saldo = 0;
                    }
                }else{
                    $pagado = 0;
                    $saldo = str_replace('.', '', $monto_ingreso[$i]);
                }

            }

            $cobro->cobro_ingreso()->create([
                'factura_sucursal' => '000',
                'factura_general' => '000',
                'factura_nro' => '000000',
                'precio' => str_replace('.', '', $precio[$i]),
                'monto_total_factura' => str_replace('.', '', $monto_ingreso[$i]),
                'monto_cobrado_factura' => $pagado,
                'monto_saldo_factura' => $saldo,
                'cantidad' => $cantidad[$i],
                'ciclo_id' => $aux_ciclo->id,
                'cobro_ingreso_concepto' => $id_concepto[$i],
                'estado_id' => 1,
                'ingreso_estado_id' => $pago_parcial,
                'alumno_id' => $alumno->id,
                'padre_ingreso_id' => 0,
                'usuario_alta' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);

            $total_pagar = $total_pagar - str_replace('.', '', $monto_ingreso[$i]);
        }

        return redirect()->route('ingreso.cobros_pendientes_detalle_imprimir', [$id, $cobro->id])->with('message', 'Cobro realizado con exito!!.');
    }

    public function nuevo_ingreso(Request $request)
    {

        $nombre = $request->nombre;
        $precio = str_replace('.', '', $request->precio);
        $unico = $request->unico;
        CobroIngresoConcepto::create([
            'nombre' => $nombre,
            'estado_id' => 1,
            'precio' => $precio,
            'unico' => $unico,
        ]);

        $data = CobroIngresoConcepto::where('estado_id', 1)
        ->get();

        return response()->json($data);

    }

    public function cobros_pendientes($id)
    {
        $alumno = Alumno::find($id);
        $date = Carbon::now();
        $ciclo = Ciclo::where('nombre', date("Y",strtotime($date)))->first();
        $cobros = CobroIngreso::join('cobro', 'cobro_ingreso.cobro_id', '=', 'cobro.id')
        ->select('cobro_ingreso.cobro_id', DB::raw('SUM(cobro_ingreso.monto_total_factura) as monto_total_factura')
        , 'cobro.fecha_cobro', 'cobro_ingreso.ingreso_estado_id')
        ->where('cobro_ingreso.alumno_id', $id)
        ->where('cobro_ingreso.ciclo_id', $ciclo->id)
        ->where('cobro_ingreso.ingreso_estado_id', 1)
        ->where('cobro_ingreso.estado_id', 1)
        ->where('cobro_ingreso.padre_ingreso_id', 0)
        ->groupBy('cobro_ingreso.cobro_id', 'cobro.fecha_cobro', 'cobro_ingreso.ingreso_estado_id')
        ->get();

        // dd($cobros);

        return view('cobro.cobros_pendiente',  compact('cobros', 'alumno'));
    }

    public function cobros_pendientes_detalle($id, $id2)
    {
        $alumno = Alumno::find($id);
        $cobros = CobroIngreso::where('cobro_id', $id2)
        ->get();
        $cobros_detalle = CobroIngreso::where('padre_ingreso_id', $id2)
        ->get();
        $tipo_cobro = TipoCobro::all();
        return view('cobro.cobro_pendiente_detalle', compact('alumno', 'cobros', 'cobros_detalle', 'tipo_cobro', 'id', 'id2'));
    }

    public function cobros_pendientes_detalle_store(Request $request, $id, $id2)
    {
        $request->validate([
            'total_a_cobrar' => 'required',
            'total_pagar_completo' => 'required',
        ]);

        $alumno = Alumno::find($id);

        if(empty($alumno)){
            return redirect()->route('alumno.index')
            ->withInput()
            ->withErrors('No existe Alumno.');
        }
        $total_a_cobrar = str_replace('.', '', $request->total_a_cobrar);
        $total_a_pagar = str_replace('.', '', $request->total_pagar_completo);
        $tipo_cobro = $request->tipo_cobro;

        if($total_a_pagar > $total_a_cobrar){
            return redirect()->route('ingreso.cobros_pendientes_detalle', [$id, $id2])
            ->withInput()
            ->withErrors('El total a pagar no puede ser mayor al total a pagar.Por favor ingrese un monto valido.');
        }

        if($total_a_pagar <= 0){
            return redirect()->route('ingreso.cobros_pendientes_detalle', [$id, $id2])
            ->withInput()
            ->withErrors('El total a pagar no puede ser menor o igual a cero!.Por favor ingrese un monto valido!.');
        }

        $date = Carbon::now();
        $anio = date("Y",strtotime($date));
        $ciclo = Ciclo::where('nombre', $anio)->first();

        $id_concepto = $request->id_concepto;
        $monto_a_cobrar = $request->monto_a_cobrar;
        $monto_cobrado = $request->monto_cobrado;
        $saldo = $request->saldo;
        $cantidad = $request->cantidad;

        if($total_a_pagar == $total_a_cobrar){
            $cobro_ant = CobroIngreso::where('cobro_id', $id2)->get();
            foreach ($cobro_ant as $item) {
                $item->ingreso_estado_id = 2;
                $item->update();
            }

        }

        $cobro = Cobro::create([
            'caja_id' => 1,
            'sede_id' => 1,
            'fecha_cobro' => $date,
            'estado_id' => 1,
            'cobro_concepto_id' => 3,
            'total_cobrado' => $total_a_pagar,
            'observacion' => 'INGRESO VARIOS',
            'tipo_cobro_id' => $tipo_cobro,
            'salida_id' => 1,
            'recibo_id' => 1,
            'usuario_alta' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
            'alumno_id' => $alumno->id,
            'grado_id' => $alumno->grado->id,
            'turno_id' => $alumno->turno->id,
            'ciclo_id' => $alumno->ciclo->id,
        ]);

        for ($i=0; $i < count($id_concepto); $i++) {

            if($saldo[$i] > 0){

                if($total_a_pagar <= 0){
                    break;
                }

                if($total_a_pagar < $saldo[$i]){
                    $nuevo_saldo = $saldo[$i] - $total_a_pagar;
                    $pago = $total_a_pagar;
                }
                if($total_a_pagar == $saldo[$i]){
                    $nuevo_saldo = 0;
                    $pago = $total_a_pagar;
                }
                if($total_a_pagar > $saldo[$i]){
                    $nuevo_saldo = 0;
                    $pago = $saldo[$i];
                }

                $cobro->cobro_ingreso()->create([
                    'factura_sucursal' => '000',
                    'factura_general' => '000',
                    'factura_nro' => '000000',
                    'precio' => str_replace('.', '', $monto_a_cobrar[$i]),
                    'monto_total_factura' => str_replace('.', '', $saldo[$i]),
                    'monto_cobrado_factura' => $pago,
                    'monto_saldo_factura' => $nuevo_saldo,
                    'cantidad' => $cantidad[$i],
                    'ciclo_id' => $ciclo->id,
                    'cobro_ingreso_concepto' => $id_concepto[$i],
                    'estado_id' => 1,
                    'ingreso_estado_id' => 2,
                    'alumno_id' => $alumno->id,
                    'padre_ingreso_id' => $id2,
                    'usuario_alta' => auth()->user()->id,
                    'usuario_modificacion' => auth()->user()->id,
                ]);

                $total_a_pagar = $total_a_pagar - $pago;
            }

        }

        return redirect()->route('ingreso.cobros_pendientes_detalle_imprimir', [$id, $cobro->id]);

    }


    public function cobros_pendientes_detalle_imprimir($id, $id2)
    {
        $alumno = Alumno::find($id);
        $cobros = Cobro::find($id2);
        $cobros_detalle = CobroIngreso::where('cobro_id', $id2)->get();
        $formatter = new NumeroALetras();

        return view('cobro.cobro_imprimir', compact('alumno', 'cobros', 'cobros_detalle', 'formatter', 'id', 'id2'));
    }

}
