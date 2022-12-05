<?php

namespace App\Http\Livewire;

use App\Models\Madre;
use Livewire\Component;
use Livewire\WithPagination;

class MadreIndex extends Component
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
            $madres = Madre::orderBy('cedula', 'ASC')->paginate(50);
        }else{
            $madres = Madre::where('cedula', 'LIKE', '%'. $search . '%')
            ->orWhere('apellido', 'LIKE', '%'. $search . '%')
            ->orWhere('nombre', 'LIKE', '%'. $search . '%')
            ->orderBy('cedula', 'ASC')
            ->paginate(50);
        }
        return view('livewire.madre-index', compact('madres'));
    }

    public function editar($padre_id)
    {
        $madre = Madre::find($padre_id);
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
