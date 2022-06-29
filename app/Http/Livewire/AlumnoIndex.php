<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use Livewire\Component;
use Livewire\WithPagination;

class AlumnoIndex extends Component
{
    public $search = "";
    use WithPagination;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $cedula =  $this->search;

        $alumnos = Alumno::where('cedula', 'LIKE', '%'.$cedula.'%')
        ->where('estado_id', 1)
        ->orWhere('nombre', 'LIKE', '%'.$cedula.'%')
        ->where('estado_id', 1)
        ->orWhere('apellido', 'LIKE', '%'.$cedula.'%')
        ->where('estado_id', 1)
        ->orderBy('apellido', 'ASC')
        ->orderBy('nombre', 'ASC')
        ->paginate(2);

        return view('livewire.alumno-index', compact('alumnos'));
    }
}
