<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ParametroGeneral;
use Illuminate\Http\Request;

class ParametroController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:parametro_general.index')->only('index');
        $this->middleware('permission:parametro_general.store')->only('create');
    }

    public function index()
    {
        $data = ParametroGeneral::first();
        return view('secundaria.parametro_general.index', compact('data'));
    }

    public function store(Request $request)
    {
        $parametro = ParametroGeneral::first();

        $parametro->update([
            'monto_multa' => str_replace('.', '', $request->monto_multa),
            'cantidad_dias_gracia' => str_replace('.', '', $request->dias_gracia),
            'usuario_modificacion' => auth()->user()->id,
        ]);

        return redirect()->route('parametro_general.index')->with('message', 'Se actualizado con exito');

    }
}
