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

class CobroController extends Controller
{
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
        ]);

        for ($i=0; $i < count($id_concepto); $i++) {

            $validar_unico = CobroIngreso::where('cobro_ingreso_concepto', $id_concepto[$i])
            ->where('ciclo_id', $aux_ciclo->id)
            ->where('estado_id', 1)
            ->first();

            if(!empty($validar_unico)){
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
                        $pagado = $total_pagar - $aux_ingre;
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

        return redirect()->route('ingreso.cobro', $id)->with('message', 'Cobro realizado con exito!!.');
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
}
