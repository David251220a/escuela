<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MatriculaIndex extends Component
{

    public $search = "";

    public function render()
    {

        $cedula =  $this->search;

        // $alumnos = Alumno::where('cedula', $cedula)
        // ->orWhere('nombre', 'LIKE', '%'.$cedula.'%')
        // ->orWhere('apellido', 'LIKE', '%'.$cedula.'%')
        // ->paginate(10);

        return view('livewire.matricula-index');
    }
}
