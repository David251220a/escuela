<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ciclo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CicloController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:ciclo.index')->only('index');
        $this->middleware('permission:ciclo.create')->only('create');
        $this->middleware('permission:ciclo.store')->only('store');
        $this->middleware('permission:ciclo.edit')->only('edit');
        $this->middleware('permission:ciclo.update')->only('update');
    }

    public function index()
    {
        $data = Ciclo::where('estado_id', 1)
        ->orderBy('año', 'DESC')->paginate(10);
        return view('ciclo.index', compact('data'));
    }

    public function create()
    {
        return view('ciclo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'anio' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ]);

        $fecha_actual = Carbon::now();
        $año_actual = $fecha_actual->format('Y');
        $año_maximo = $año_actual + 5;
        $año_mimino = $año_actual - 5;
        $fecha_inicio = date('d/m/Y', strtotime($request->fecha_inicio));
        $fecha_fin = date('d/m/Y', strtotime($request->fecha_fin));
        $año_inicio = date('Y', strtotime($fecha_inicio));
        $año_fin = date('Y', strtotime($fecha_fin));

        if($año_inicio != $año_fin){
            return redirect()->route('ciclo.create')
            ->withInput()
            ->withErrors('La fecha Inicial y Final no pertenecen al mismo año!!!.');
        }

        if($request->anio != $año_fin){
            return redirect()->route('ciclo.create')
            ->withInput()
            ->withErrors('El año ingresado no pertenece al año establecido en la fecha de inicio y fin!!!!.');
        }

        if($año_maximo < $año_inicio){
            return redirect()->route('ciclo.create')
            ->withInput()
            ->withErrors('El año maximo establecido es de: ' .$año_maximo);
        }

        if($año_mimino > $año_inicio){
            return redirect()->route('ciclo.create')
            ->withInput()
            ->withErrors('El año minimo establecido es de: ' .$año_mimino);
        }

        if($fecha_inicio > $fecha_fin){
            return redirect()->route('ciclo.create')
            ->withInput()
            ->withErrors('La Fecha Inicial no debe ser mayor a la Fecha Final!!.');
        }

        $exite = Ciclo::where('año', $request->anio)
        ->where('estado_id', 1)
        ->first();

        if($exite){
            return redirect()->route('ciclo.create')
            ->withInput()
            ->withErrors('Ya existe un ciclo creado del año: '.$request->anio);
        }

        $fecha_inicio = date("d-m-Y", strtotime($request->fecha_inicio));
        $fecha_fin = date("d-m-Y", strtotime($request->fecha_fin));
        $meses = date_diff(date_create($fecha_inicio), date_create($fecha_fin));

        Ciclo::create([
            'sede_id' => 1,
            'nombre' => $request->anio,
            'meses' => $meses->m + 1,
            'año' => $request->anio,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'usuario_alta' => auth()->user()->id,
            'estado_id' => 1,
        ]);

        return redirect()->route('ciclo.index')->with('message', 'Creación exitosa!!.');

    }

    public function edit(Ciclo $ciclo)
    {
        return view('ciclo.edit', compact('ciclo'));
    }

    public function update(Ciclo $ciclo, Request $request)
    {
        $request->validate([
            'anio' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ]);

        $fecha_actual = Carbon::now();
        $año_actual = $fecha_actual->format('Y');
        $año_maximo = $año_actual + 5;
        $año_mimino = $año_actual - 5;
        $fecha_inicio = date('d/m/Y', strtotime($request->fecha_inicio));
        $fecha_fin = date('d/m/Y', strtotime($request->fecha_fin));
        $año_inicio = date('Y', strtotime($fecha_inicio));
        $año_fin = date('Y', strtotime($request->fecha_fin));

        if($año_inicio != $año_fin){
            return redirect()->back()
            ->withInput()
            ->withErrors('La fecha Inicial y Final no pertenecen al mismo año!!!.');
        }

        if($request->anio != $año_fin){
            return redirect()->back()
            ->withInput()
            ->withErrors('El año ingresado no pertenece al año establecido en la fecha de inicio y fin!!!!.');
        }

        if($año_maximo < $año_inicio){
            return redirect()->back()
            ->withInput()
            ->withErrors('El año maximo establecido es de: ' .$año_maximo);
        }

        if($año_mimino > $año_inicio){
            return redirect()->back()
            ->withInput()
            ->withErrors('El año minimo establecido es de: ' .$año_mimino);
        }

        if($fecha_inicio > $fecha_fin){
            return redirect()->back()
            ->withInput()
            ->withErrors('La Fecha Inicial no debe ser mayor a la Fecha Final!!.');
        }

        $fecha_inicio = date("d-m-Y", strtotime($request->fecha_inicio));
        $fecha_fin = date("d-m-Y", strtotime($request->fecha_fin));
        $meses = date_diff(date_create($fecha_inicio), date_create($fecha_fin));

        $ciclo->update([
            'nombre' => $request->anio,
            'meses' => $meses->m + 1,
            'año' => $request->anio,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estado_id' => $request->estado_id,
        ]);

        return redirect()->route('ciclo.index')->with('message', 'Actualización exitosa!!.');
    }
}
