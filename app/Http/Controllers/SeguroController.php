<?php

namespace App\Http\Controllers;

use App\Models\Seguro;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeguroController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:seguro.index')->only('index');
        $this->middleware('permission:seguro.create')->only('create');
        $this->middleware('permission:seguro.store')->only('store');
        $this->middleware('permission:seguro.show')->only('show');
        $this->middleware('permission:seguro.edit')->only('edit');
        $this->middleware('permission:seguro.update')->only('update');
    }

    public function index(Request $request)
    {
        //consulta a la Base de Datos
        $seguro = Seguro::where('estado_id',1)->get();
        //esto es para ver que trae
        // dd($alergias);
        //para retornar a la vista
        return view('secundaria.seguro.index', compact('seguro'));
    }


    public function create(){

        return view('secundaria.seguro.create');

    }


    public function edit(Seguro $seguro){
        return view('secundaria.seguro.edit', compact('seguro'));
    }

    public function update(Request $request,Seguro $seguro){
        // return view('secundaria.alergia.edit', compact('alergia'));

        //sirve para ver que te trae el request.
        // dd($request->all());


        $_nombre=$request->nombre;
        $_estado_id=$request->estado_id;
        $_user_id =  auth()->user()->id;

        $seguro->nombre=$_nombre;
        $seguro->estado_id=$_estado_id;
        $seguro->usuario_modificacion=$_user_id;
        $seguro->update();

        return redirect()->route('seguro.index')->with('message', 'Se actualizo con exito el Seguro!.') ;


    }

    public function store(Request $request){

        $_nombre = $request->nombre;
        $_estado_id = $request->estado_id;

        Seguro::create([
            'nombre' => $_nombre,
            'estado_id' => $_estado_id,
            'usuario_grabacion' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
        ]);

        return redirect()->route('seguro.index')->with('message', 'Se creo con exito el Seguro!.') ;


    }





}
