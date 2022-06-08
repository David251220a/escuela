<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\CobroIngresoConcepto;
use Illuminate\Http\Request;

class CobroController extends Controller
{
    public function cobros_varios(Request $request, $id)
    {
        $alumno = Alumno::find($id);
        $ingreso_concepto = CobroIngresoConcepto::where('estado_id', 1)
        ->get();

        return view('cobro.cobro', compact('ingreso_concepto', 'alumno'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function nuevo_ingreso(Request $request)
    {

        $nombre = $request->nombre;
        $precio = str_replace('.', '', $request->precio);

        CobroIngresoConcepto::create([
            'nombre' => $nombre,
            'estado_id' => 1,
            'precio' => $precio,
        ]);

        $data = CobroIngresoConcepto::where('estado_id', 1)
        ->get();

        return response()->json($data);

    }
}
