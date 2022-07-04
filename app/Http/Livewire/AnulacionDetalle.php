<?php

namespace App\Http\Livewire;

use App\Models\Cobro;
use Livewire\Component;

class AnulacionDetalle extends Component
{

    public $open = false;
    public $cobro = '';

    public function mount(Cobro $cobro)
    {
        $this->cobro = $cobro;
    }

    public function render()
    {
        $cobro = $this->cobro;
        return view('livewire.anulacion-detalle', compact('cobro'));
    }
}
