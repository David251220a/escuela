<?php

namespace App\Http\Livewire\Alumno;

use App\Models\Alumno;
use App\Models\AlumnoDocumento;
use Livewire\Component;

class DocumentosDescargas extends Component
{

    public $alumno, $documentos;

    public function mount(Alumno $alumno)
    {

        //$documentos = AlumnoDocumento
    }

    public function render()
    {
        return view('livewire.alumno.documentos-descargas');
    }
}
