<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Cobro;
use App\Models\CobroConcepto;
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

    protected $listeners = ['render'];

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
            $cobros = Cobro::where('alumno_id', $alumno)
            ->whereYear('fecha_cobro', $fecha_actual)
            ->orderBy('fecha_cobro', 'DESC')
            ->get();
        }

        if($seleccion == 2){
            $cobros = Cobro::where('alumno_id', $alumno)
            ->where('id', $numero)
            ->whereYear('fecha_cobro', $fecha_actual)
            ->orderBy('fecha_cobro', 'DESC')
            ->get();
        }

        if($seleccion == 3){

            // $dt = Carbon::createFromFormat('Y-m-d', $fecha_desde);
            // $dt2 = Carbon::createFromFormat('Y-m-d', $fecha_hasta);
            if (strlen($fecha_hasta) == 10) {
                $dt2 = Carbon::createFromFormat('Y-m-d', $fecha_hasta);
                if($dt2 != false){
                    $cobros = Cobro::where('alumno_id', $alumno)
                    ->whereBetween(DB::raw('CAST(fecha_cobro)'),[$fecha_desde, $fecha_hasta])
                    ->whereYear('fecha_cobro', $fecha_actual)
                    ->orderBy('fecha_cobro', 'DESC')
                    ->get();
                }

            }
            $cobros = Cobro::where('alumno_id', $alumno)
            ->whereYear('fecha_cobro', $fecha_actual)
            ->orderBy('fecha_cobro', 'DESC')
            ->get();
        }

        $tipo_consulta = CobroConcepto::where('estado_id', 1)->get();
        return view('livewire.anulacion-show', compact('tipo_consulta', 'cobros'));
    }

}
