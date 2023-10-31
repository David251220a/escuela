<?php

namespace App\Http\Livewire\Alumno;

use App\Models\Alumno;
use App\Models\AlumnoDocumento;
use App\Models\Ciclo;
use App\Models\DocumentosAlumno;
use App\Models\User;
use Livewire\Component;

class DocumentosDescargas extends Component
{

    public $alumno, $documentos, $data = [];

    public function mount()
    {

    }

    public function render()
    {
        $user = auth()->user();
        $ciclo = Ciclo::where('estado_id', 1)
        ->first();
        $alumno = Alumno::where('cedula', $user->documento)->first();

        if ($alumno) {

            $documentos = DocumentosAlumno::where('alumno_id', $alumno->id)
            ->where('ciclo_id', $ciclo->id)
            ->get();

            if (count($documentos) > 0){
                $this->data = $documentos;
            }else{
                DocumentosAlumno::create([
                    'alumno_id' => $alumno->id,
                    'ciclo_id' => $ciclo->id,
                    'descripcion' => 'Documentos de prueba',
                    'pdf' => 'public/docu/documentos1.pdf',
                    'leido' => 0,
                ]);

                dd("a");

                $documentos = DocumentosAlumno::where('alumno_id', $alumno->id)
                ->where('ciclo_id', $ciclo->id)
                ->get();

                $this->data = $documentos;
            }
        }

        return view('livewire.alumno.documentos-descargas');
    }

    public function actualizar($id)
    {
        $documento = DocumentosAlumno::find($id);
        //dd($documento , $id);
        $documento->leido = 1;
        $documento->update();
    }

}
