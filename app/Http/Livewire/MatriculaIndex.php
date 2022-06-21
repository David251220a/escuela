<?php

namespace App\Http\Livewire;

use App\Models\Matricula;
use Livewire\Component;

class MatriculaIndex extends Component
{

    public $search = "";

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
}
