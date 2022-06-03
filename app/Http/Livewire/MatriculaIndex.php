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
            ->paginate(10);
        }else{
            $matricula = Matricula::where('matricula.estado_id', 1)
            ->where('a.cedula', $cedula)
            ->join('alumno AS a', 'matricula.alumno_id', '=', 'a.id')
            ->paginate(10);
        }

        return view('livewire.matricula-index', compact('matricula'));
    }
}
