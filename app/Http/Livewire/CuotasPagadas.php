<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use Livewire\Component;

class CuotasPagadas extends Component
{

    public $search = "";

    public function render()
    {
        $cedula =  $this->search;

        $alumnos = Alumno::where('cedula', 'LIKE', '%'.$cedula.'%')
        ->orWhere('nombre', 'LIKE', '%'.$cedula.'%')
        ->orWhere('apellido', 'LIKE', '%'.$cedula.'%')
        ->orderBy('apellido', 'ASC')
        ->orderBy('nombre', 'ASC')
        ->paginate(10);

        return view('livewire.cuotas-pagadas', compact('alumnos'));
    }
}
