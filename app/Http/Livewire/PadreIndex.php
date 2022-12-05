<?php

namespace App\Http\Livewire;

use App\Models\Padre;
use Livewire\Component;
use Livewire\WithPagination;

class PadreIndex extends Component
{
    use WithPagination;
    public $search = "" , $titulo
    , $nombre, $apellido, $telefono_particular, $telefono_wapp, $lugar_trabajo, $direccion, $horario_dias_trabajo
    , $telefono_laboral, $madre_id, $cedula;



    protected $listeners = ['render', 'editar'];

    public function mount($titulo)
    {
        $this->titulo = $titulo;
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $search = trim($this->search);

        if (empty($search)){
            $padres = Padre::orderBy('cedula', 'ASC')->paginate(50);
        }else{
            $padres = Padre::where('cedula', 'LIKE', '%'. $search . '%')
            ->orWhere('apellido', 'LIKE', '%'. $search . '%')
            ->orWhere('nombre', 'LIKE', '%'. $search . '%')
            ->orderBy('cedula', 'ASC')
            ->paginate(50);
        }
        return view('livewire.padre-index', compact('padres'));
    }

    public function editar($padre_id)
    {
        $madre = Padre::find($padre_id);
        $this->cedula = $madre->cedula;
        $this->madre_id = $madre->id;
        $this->nombre = $madre->nombre;
        $this->apellido = $madre->apellido;
        $this->telefono_particular = $madre->telefono_particular;
        $this->telefono_wapp = $madre->telefono_wapp;
        $this->lugar_trabajo = $madre->lugar_trabajo;
        $this->direccion = $madre->direccion;
        $this->horario_dias_trabajo = $madre->horario_dias_trabajo;
        $this->telefono_laboral = $madre->telefono_laboral;
        $this->emit('ver_editar', 'Editar');
    }

}
