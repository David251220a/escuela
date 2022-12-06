<?php

namespace App\Http\Livewire;

use App\Models\Encargado;
use Livewire\Component;

class EncargadoIndex extends Component
{
    public $search = "" , $nombre
    , $cedula, $parentezco, $telefono, $observacion, $encargado_id;

    protected $listeners = ['render', 'editar'];

    public function updatingSearch(){
        $this->resetPage();
    }


    public function render()
    {
        $search = trim($this->search);
        if($search){
            $encargados = Encargado::where('cedula', 'LIKE', '%'. $search . '%')
            ->orWhere('nombre', 'LIKE', '%'. $search . '%')
            ->orderBy('cedula', 'ASC')
            ->paginate(20);
        }else{
            $encargados = Encargado::orderBy('cedula', 'ASC')
            ->paginate(20);
        }

        return view('livewire.encargado-index', compact('encargados'));
    }

    public function editar($encargado_id){
        $encargado = Encargado::find($encargado_id);
        $this->cedula = $encargado->cedula;
        $this->encargado_id = $encargado->id;
        $this->nombre = $encargado->nombre;
        $this->parentezco = $encargado->parentezco;
        $this->telefono = $encargado->telefono;
        $this->observacion = $encargado->observacion;
        $this->emit('ver_editar', 'Editar');
    }

}
