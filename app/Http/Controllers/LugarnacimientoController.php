<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LugarNacimiento;

class LugarnacimientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lugarnacimiento.index')->only('index');
        $this->middleware('permission:lugarnacimiento.create')->only('create');
        $this->middleware('permission:lugarnacimiento.store')->only('store');
        $this->middleware('permission:lugarnacimiento.show')->only('show');
        $this->middleware('permission:lugarnacimiento.edit')->only('edit');
        $this->middleware('permission:lugarnacimiento.update')->only('update');
    }

    public function index(Request $request)
    {
        //consulta a la Base de Datos
        $lugar_nacimiento =  Lugarnacimiento::where('estado_id',1)->get();
        //esto es para ver que trae
        // dd($alergias);
        //para retornar a la vista
        return view('secundaria.lugarnacimiento.index', compact('lugar_nacimiento'));
    }

    public function create(){

        return view('secundaria.lugarnacimiento.create');

    }


    public function edit(Lugarnacimiento $lugarnacimiento){
        return view('secundaria.lugarnacimiento.edit', compact('lugarnacimiento'));
    }

    public function update(Request $request,Lugarnacimiento $lugarnacimiento){
        // return view('secundaria.alergia.edit', compact('alergia'));

        //sirve para ver que te trae el request.
        // dd($request->all());


        $_nombre=$request->nombre;
        $_estado_id=$request->estado_id;
        $_user_id =  auth()->user()->id;

        $lugarnacimiento->nombre=$_nombre;
        $lugarnacimiento->estado_id=$_estado_id;
        $lugarnacimiento->usuario_modificacion=$_user_id;
        $lugarnacimiento->update();

        return redirect()->route('lugarnacimiento.index')->with('message', 'Se actualizo con exito el Lugar de Nacimiento!.') ;


    }

    public function store(Request $request){

        $_nombre = $request->nombre;
        $_estado_id = $request->estado_id;

        Lugarnacimiento::create([
            'nombre' => $_nombre,
            'estado_id' => $_estado_id,
            'usuario_grabacion' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
        ]);

        return redirect()->route('lugarnacimiento.index')->with('message', 'Se creo con exito el Lugar de Nacimiento!.') ;


    }

}
