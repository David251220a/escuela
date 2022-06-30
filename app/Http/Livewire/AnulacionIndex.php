<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use Livewire\Component;
use Livewire\WithPagination;

class AnulacionIndex extends Component
{
    use WithPagination;
    public $search = "";
    public $activo = 1;

    protected $listeners = ['render', 'cambio_activo'];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $busqueda = $this->search;
        $estado = $this->activo;

        $alumnos = Alumno::where('cedula', 'LIKE', '%'.$busqueda.'%')
        ->where('estado_id', $estado)
        ->orWhere('nombre', 'LIKE', '%'.$busqueda.'%')
        ->where('estado_id', $estado)
        ->orWhere('apellido', 'LIKE', '%'.$busqueda.'%')
        ->where('estado_id', $estado)
        ->orderBy('apellido', 'ASC')
        ->orderBy('nombre', 'ASC')
        ->paginate(10);

        return view('livewire.anulacion-index', compact('alumnos'));
    }

    public function cambio_activo(Alumno $alumno)
    {
        if($alumno->estado_id == 1){
            $estado_id = 2;
        }

        if($alumno->estado_id == 2){
            $estado_id = 1;
        }

        $alumno->update([
            'estado_id' => $estado_id,
            'usuario_modificacion' => auth()->user()->id,
        ]);


    }

}
