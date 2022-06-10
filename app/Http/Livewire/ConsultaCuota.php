<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use Livewire\Component;

class ConsultaCuota extends Component
{
    public $search = "";

    public function render()
    {
        $cedula =  $this->search;

        $alumnos = Alumno::where('cedula', 'LIKE','%'.$cedula.'%')
        ->orWhere('nombre', 'LIKE', '%'.$cedula.'%')
        ->orWhere('apellido', 'LIKE', '%'.$cedula.'%')
        ->paginate(10);

        return view('livewire.consulta-cuota', compact('alumnos'));
    }
}
