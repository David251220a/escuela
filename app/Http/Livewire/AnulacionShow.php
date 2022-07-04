<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Cobro;
use App\Models\CobroConcepto;
use App\Models\CobroIngreso;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AnulacionShow extends Component
{

    use WithPagination;

    public $search = "";
    public $consulta = 0;
    public $fecha_desde = "";
    public $fecha_hasta = "";
    public $alumno_id = 0;
    public $seleccion = 1;

    protected $listeners = ['render', 'anular_cobro'];

    public function mount(Alumno $alumno)
    {
        $this->alumno_id = $alumno->id;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $numero = str_replace('.', '', $this->search);
        $consulta = $this->consulta;
        $fecha_desde = $this->fecha_desde;
        $fecha_hasta = $this->fecha_hasta;
        $alumno = $this->alumno_id;
        $seleccion = $this->seleccion;
        $fecha_actual = Carbon::now();
        $year = date("Y",strtotime($fecha_actual));

        if($seleccion == 1){

            if($consulta == 0){
                $cobros = Cobro::where('alumno_id', $alumno)
                ->whereYear('fecha_cobro', $fecha_actual)
                ->where('estado_id', 1)
                ->orderBy('fecha_cobro', 'DESC')
                ->paginate(20);
            }else{
                $cobros = Cobro::where('alumno_id', $alumno)
                ->whereYear('fecha_cobro', $fecha_actual)
                ->where('cobro_concepto_id', $consulta)
                ->where('estado_id', 1)
                ->orderBy('fecha_cobro', 'DESC')
                ->paginate(20);
            }

        }

        if($seleccion == 2){
            if($consulta == 0){
                $cobros = Cobro::where('alumno_id', $alumno)
                ->where('id', $numero)
                ->whereYear('fecha_cobro', $fecha_actual)
                ->where('estado_id', 1)
                ->orderBy('fecha_cobro', 'DESC')
                ->paginate(20);
            }else{
                $cobros = Cobro::where('alumno_id', $alumno)
                ->where('id', $numero)
                ->whereYear('fecha_cobro', $fecha_actual)
                ->where('estado_id', 1)
                ->where('cobro_concepto_id', $consulta)
                ->orderBy('fecha_cobro', 'DESC')
                ->paginate(20);
            }

        }

        if($seleccion == 3){

            if($consulta == 0){
                if (strlen($fecha_hasta) == 10) {
                    $dt2 = Carbon::createFromFormat('Y-m-d', $fecha_hasta);
                    if($dt2 != false){
                        $cobros = Cobro::where('alumno_id', $alumno)
                        ->whereBetween(DB::raw('CAST(fecha_cobro AS DATE)'),[$fecha_desde, $fecha_hasta])
                        ->where('estado_id', 1)
                        ->whereYear('fecha_cobro', $fecha_actual)
                        ->orderBy('fecha_cobro', 'DESC')
                        ->paginate(20);
                    }

                }else{
                    $cobros = Cobro::where('alumno_id', $alumno)
                    ->where('estado_id', 1)
                    ->whereYear('fecha_cobro', $fecha_actual)
                    ->orderBy('fecha_cobro', 'DESC')
                    ->paginate(20);
                }

            }else{
                if (strlen($fecha_hasta) == 10) {
                    $dt2 = Carbon::createFromFormat('Y-m-d', $fecha_hasta);
                    if($dt2 != false){
                        $cobros = Cobro::where('alumno_id', $alumno)
                        ->whereBetween(DB::raw('CAST(fecha_cobro AS DATE)'),[$fecha_desde, $fecha_hasta])
                        ->where('cobro_concepto_id', $consulta)
                        ->whereYear('fecha_cobro', $fecha_actual)
                        ->where('estado_id', 1)
                        ->orderBy('fecha_cobro', 'DESC')
                        ->paginate(20);
                    }

                }else{
                    $cobros = Cobro::where('alumno_id', $alumno)
                    ->whereYear('fecha_cobro', $fecha_actual)
                    ->where('cobro_concepto_id', $consulta)
                    ->where('estado_id', 1)
                    ->orderBy('fecha_cobro', 'DESC')
                    ->paginate(20);
                }

            }

        }

        $tipo_consulta = CobroConcepto::where('estado_id', 1)->get();
        return view('livewire.anulacion-show', compact('tipo_consulta', 'cobros'));
    }

    public function anular_cobro(Cobro $cobro)
    {
        $data['ok'] = "Todo Bien";
        if($cobro->cobro_concepto_id == 1){
            $cobro->estado_id = 2;
            $cobro->usuario_modificacion = auth()->user()->id;
            $cobro->update();

            foreach($cobro->cobro_matricula as $item){
                $item->estado_id = 2;
                $item->usuario_modificacion = auth()->user()->id;
                $item->update();
            }
        }

        if($cobro->cobro_concepto_id == 2){
            $cobro->estado_id = 2;
            $cobro->usuario_modificacion = auth()->user()->id;
            $cobro->update();

            foreach ($cobro->cobro_matricula_cuota as $item) {
                $item->estado_id = 2;
                $item->usuario_modificacion = auth()->user()->id;
                $item->update();

                $item->matricula_cuota->update([
                    'monto_cuota_cobrado' => $item->matricula_cuota->monto_cuota_cobrado - $item->monto_cobrado_cuota,
                    'saldo' => ($item->matricula_cuota->monto_cuota_cobrar - ($item->matricula_cuota->monto_cuota_cobrado - $item->monto_cobrado_cuota)),
                    'monto_multa_cobrar' => $item->matricula_cuota->monto_multa_cobrado - $item->monto_multa_a_cobrado,
                    'monto_multa_cobrado' => $item->matricula_cuota->monto_multa_cobrado - $item->monto_multa_a_cobrado,
                    'monto_cobrado' => $item->matricula_cuota->monto_cobrado - $item->monto_cobrado_cuota - $item->monto_multa_a_cobrado,
                    'total_cuota' => $item->matricula_cuota->monto_cuota_cobrar + ($item->matricula_cuota->monto_multa_cobrado - $item->monto_multa_a_cobrado),
                    'usuario_modificacion' => auth()->user()->id,
                ]);
            }
        }

        if($cobro->cobro_concepto_id == 3){

            $cobro->estado_id = 2;
            $cobro->usuario_modificacion = auth()->user()->id;
            $cobro->update();
            $i = 1;

            foreach ($cobro->cobro_ingreso as $item) {
                $item->update([
                    'ingreso_estado_id' => 1,
                    'estado_id' => 2,
                    'usuario_modificacion' => auth()->user()->id,
                ]);

                if($i == 1){
                    if($item->padre_ingreso_id == 0){
                        $cobro_ingreso = CobroIngreso::where('padre_ingreso_id', $item->cobro_id)->get();
                        foreach ($cobro_ingreso as $itemn) {
                            $itemn->update([
                                'ingreso_estado_id' => 1,
                                'estado_id' => 2,
                                'usuario_modificacion' => auth()->user()->id,
                            ]);

                            $itemn->cobros->update([
                                'estado_id' => 2,
                                'usuario_modificacion' => auth()->user()->id,
                            ]);
                        }
                    }elseif($item->padre_ingreso_id > 0){
                        $cobro_ingreso = CobroIngreso::where('cobro_id', $item->padre_ingreso_id)->get();
                        foreach ($cobro_ingreso as $itemn) {
                            $itemn->update([
                                'ingreso_estado_id' => 1,
                                'usuario_modificacion' => auth()->user()->id,
                            ]);
                        }
                    }
                }

                $i= $i + 1;

            }


        }
    }

}
