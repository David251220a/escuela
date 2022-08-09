<?php

namespace App\Http\Livewire;

use App\Models\Matricula;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Node\Stmt\TryCatch;

class MatriculaIndex extends Component
{
    use WithPagination;
    public $search = "";

    protected $listeners = ['render', 'anular_matricula'];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $cedula =  $this->search;

        if(empty($cedula)){
            $matricula = Matricula::where('matricula.estado_id',1)
            ->join('alumno AS a', 'matricula.alumno_id', '=', 'a.id')
            ->select('matricula.*', 'a.cedula', 'a.nombre', 'a.apellido')
            ->orderBy('a.apellido', 'ASC')
            ->orderBy('a.nombre', 'ASC')
            ->paginate(10);
        }else{
            $matricula = Matricula::where('matricula.estado_id', 1)
            ->join('alumno AS a', 'matricula.alumno_id', '=', 'a.id')
            ->select('matricula.*', 'a.cedula', 'a.nombre', 'a.apellido')
            ->where('a.cedula', $cedula)
            ->orWhere('a.nombre', 'LIKE', '%'.$cedula.'%')
            ->orWhere('a.apellido', 'LIKE', '%'.$cedula.'%')
            ->orderBy('a.apellido', 'ASC')
            ->orderBy('a.nombre', 'ASC')
            ->paginate(10);
        }

        return view('livewire.matricula-index', compact('matricula'));
    }

    public function anular_matricula(Matricula $matricula)
    {
        // dd($matricula);

        DB::beginTransaction();
        try {

            $matricula->update([
                'matricula_estado_id' => 3,
                'estado_id' => 2,
                'usuario_modificacion' => auth()->user()->id,
            ]);

            //PONER EL ALUMNOS LOS GRADO Y TURNO EN SIN ESPECIFICAR
            $matricula->alumnos->update([
                'grado_id' => 1,
                'turno_id' => 1,
            ]);

            //ANULAR LAS MATRICULA CUOTA $ITEM
            foreach ($matricula->cuotas as $item){
                $item->update([
                    'estado_id' => 2,
                    'usuario_modificacion' => auth()->user()->id,
                ]);

                //SI LA CUOTA TIENE UN COBRO ANULA EL COBRO
                if( count($item->cuota_pagada) > 0 ){
                    foreach ($item->cuota_pagada as $cuota_pago) {
                        $cuota_pago->update([
                            'estado_id' => 2,
                            'usuario_modificacion' => auth()->user()->id,
                        ]);
                        //ANULA LA CABEZERA DEL COBRO
                        $cuota_pago->cobros->update([
                            'estado_id' => 2,
                            'usuario_modificacion' => auth()->user()->id,
                        ]);

                    }
                }
            }
            //ANULA LA MATRICULA
            if(count($matricula->cobro_matricula) > 0){
                foreach ($matricula->cobro_matricula as $cobro_matricula){
                    $cobro_matricula->update([
                        'estado_id' => 2,
                        'usuario_modificacion' => auth()->user()->id,
                    ]);

                    $cobro_matricula->cobros->update([
                        'estado_id' => 2,
                        'usuario_modificacion' => auth()->user()->id,
                    ]);
                }
            }

            DB::commit();
            $this->emit('exito', 'Se anulo con exito');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('fallo', 'No se pudo Anular');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('fallo', 'No se pudo Anular');
        }

    }
}
