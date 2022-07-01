<?php

namespace App\Http\Controllers;

use App\Models\Nacionalidad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NacionalidadController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:nacionalidad.index')->only('index');
        $this->middleware('permission:nacionalidad.create')->only('create');
        $this->middleware('permission:nacionalidad.store')->only('store');
        $this->middleware('permission:nacionalidad.show')->only('show');
        $this->middleware('permission:nacionalidad.edit')->only('edit');
        $this->middleware('permission:nacionalidad.update')->only('update');
    }

    public function index(Request $request)
    {
        //consulta a la Base de Datos
        $nacionalidad = Nacionalidad::where('estado_id',1)->get();
        //esto es para ver que trae
        // dd($alergias);
        //para retornar a la vista
        return view('secundaria.nacionalidad.index', compact('nacionalidad'));
    }


    public function create(){

        return view('secundaria.nacionalidad.create');

    }


    public function edit(Nacionalidad $nacionalidad){
        return view('secundaria.nacionalidad.edit', compact('nacionalidad'));
    }

    public function update(Request $request,Nacionalidad $nacionalidad){
        // return view('secundaria.alergia.edit', compact('alergia'));

        //sirve para ver que te trae el request.
        // dd($request->all());


        $_nombre=$request->nombre;
        $_estado_id=$request->estado_id;
        $_user_id =  auth()->user()->id;

        $nacionalidad->nombre=$_nombre;
        $nacionalidad->estado_id=$_estado_id;
        $nacionalidad->usuario_modificacion=$_user_id;
        $nacionalidad->update();

        return redirect()->route('nacionalidad.index')->with('message', 'Se actualizo con exito la Nacionalidad!.') ;


    }

    public function store(Request $request){

        $_nombre = $request->nombre;
        $_estado_id = $request->estado_id;

        Nacionalidad::create([
            'nombre' => $_nombre,
            'estado_id' => $_estado_id,
            'usuario_grabacion' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
        ]);

        return redirect()->route('nacionalidad.index')->with('message', 'Se creo con exito la Nacionalidad!.') ;


    }





}
