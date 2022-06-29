<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use Livewire\Component;
use Livewire\WithPagination;

class ConsultaCuota extends Component
{
    use WithPagination;
    public $search = "";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $cedula =  $this->search;

        $alumnos = Alumno::where('cedula', 'LIKE','%'.$cedula.'%')
        ->orWhere('nombre', 'LIKE', '%'.$cedula.'%')
        ->orWhere('apellido', 'LIKE', '%'.$cedula.'%')
        ->orderBy('apellido', 'ASC')
        ->orderBy('nombre', 'ASC')
        ->paginate(10);

        return view('livewire.consulta-cuota', compact('alumnos'));
    }
}
