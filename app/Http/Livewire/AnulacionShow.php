<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\CobroConcepto;
use Livewire\Component;
use Livewire\WithPagination;

class AnulacionShow extends Component
{

    use WithPagination;

    public $search = "";
    public $consulta = 0;
    public $fecha = "";
    public $alumno_id = 0;

    protected $listeners = ['render'];

    public function mount(Alumno $alumno)
    {
        $this->alumno_id = $alumno->id;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $tipo_consulta = CobroConcepto::where('estado_id', 1)->get();
        return view('livewire.anulacion-show');
    }
}
