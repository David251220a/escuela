<?php

namespace App\Http\Livewire;

use App\Models\CobroMatricula;
use App\Models\CobroMatriculaCuota;
use App\Models\Grado;
use App\Models\TipoCobro;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ConsultaCobroscuota extends Component
{
    public $turno_id, $grado_id, $busqueda_id, $fecha_desde, $fecha_hasta, $tipo_cobro_id, $datos = [] ,$datos_aux;

    public function mount()
    {
        // $this->data = [];
        // $this->data_aux = [];
        $this->turno_id = 1;
        $this->grado_id = 1;
        $this->busqueda_id = 1;
        $this->tipo_cobro_id = 999;

    }

    public function render()
    {
        $grado = Grado::where('estado_id', 1)->get();
        $turno = Turno::where('estado_id', 1)->get();
        $tipo_cobro = TipoCobro::where('estado_id', 1)->get();

        return view('livewire.consulta-cobroscuota', compact('grado', 'turno', 'tipo_cobro'));
    }

    public function filtrar()
    {

        if($this->busqueda_id == 1){

            if(($this->validar_fecha_espanol($this->fecha_desde)) && ($this->validar_fecha_espanol($this->fecha_hasta))){

                $fecha_desde =  date('Y-m-d', strtotime($this->fecha_desde));
                $fecha_hasta =  date('Y-m-d', strtotime($this->fecha_hasta));

                if($this->tipo_cobro_id == 999){
                    $forma_cobro_ini = 1;
                }else{
                    $forma_cobro_ini = $this->tipo_cobro_id;
                }

                $this->datos = CobroMatriculaCuota::join('matricula', 'cobro_matricula_cuota.matricula_id', '=', 'matricula.id')
                ->join('cobro', 'cobro_matricula_cuota.cobro_id', '=', 'cobro.id')
                ->select('cobro_matricula_cuota.*', 'cobro.fecha_cobro', 'matricula.grado_id','matricula.turno_id')
                ->where('cobro.estado_id', 1)
                ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$fecha_desde, $fecha_hasta])
                ->where('matricula.turno_id', $this->turno_id)
                ->where('matricula.grado_id', $this->grado_id)
                ->where('cobro.tipo_cobro_id', '<=', $this->tipo_cobro_id)
                ->where('cobro.tipo_cobro_id', '>=', $forma_cobro_ini)
                ->get();

            }else{

            }

        }else{

            if(($this->validar_fecha_espanol($this->fecha_desde)) && ($this->validar_fecha_espanol($this->fecha_hasta))){

                $fecha_desde =  date('Y-m-d', strtotime($this->fecha_desde));
                $fecha_hasta =  date('Y-m-d', strtotime($this->fecha_hasta));

                if($this->tipo_cobro_id == 999){
                    $forma_cobro_ini = 1;
                }else{
                    $forma_cobro_ini = $this->tipo_cobro_id;
                }

                $this->datos = CobroMatricula::join('matricula', 'cobro_matricula.matricula_id', '=', 'matricula.id')
                ->join('cobro', 'cobro_matricula.cobro_id', '=', 'cobro.id')
                ->where('cobro.estado_id', 1)
                ->whereBetween(DB::raw('CAST(cobro.fecha_cobro AS DATE)'),[$fecha_desde, $fecha_hasta])
                ->where('matricula.turno_id', $this->turno_id)
                ->where('matricula.grado_id', $this->grado_id)
                ->where('cobro.tipo_cobro_id', '<=', $this->tipo_cobro_id)
                ->where('cobro.tipo_cobro_id', '>=', $forma_cobro_ini)
                ->orderBy('cobro.fecha_cobro', 'DESC')
                ->get();
            }else{

            }
        }

    }

    function validar_fecha_espanol($fecha){
        $valores = explode('-', $fecha);
        // dd($valores);
        if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0]) && ($valores[0] >= 2021) && ($valores[0] <= 9999)){
        // if((count($valores) == 3) && checkdate($valores[1], $valores[2], $valores[0])){
            return true;
        }
        return false;
    }
}
