<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaisController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:alergia.index')->only('index');
        $this->middleware('permission:alergia.create')->only('create');
        $this->middleware('permission:alergia.store')->only('store');
        $this->middleware('permission:alergia.show')->only('show');
        $this->middleware('permission:alergia.edit')->only('edit');
        $this->middleware('permission:alergia.update')->only('update');
    }

    public function index(Request $request)
    {
        //consulta a la Base de Datos
        //consulta a la base de datos en donde el estado del pais sea Activo = 1.
        $pais = Pais::where('estado_id',1)->get();
        //esto es para ver que trae
        // dd($alergias);
        //para retornar a la vista
        return view('secundaria.pais.index', compact('pais'));
    }


    public function create(){

        return view('secundaria.pais.create');

    }


    public function edit(Pais $pai){
        $pais = $pai;
        return view('secundaria.pais.edit', compact('pais'));
    }

    public function update(Request $request,Pais $pai){
        // return view('secundaria.alergia.edit', compact('alergia'));

        //sirve para ver que te trae el request.
        // dd($request->all());


        $_nombre=$request->nombre;
        $_estado_id=$request->estado_id;
        $_user_id =  auth()->user()->id;


        $pai->nombre=$_nombre;
        $pai->estado_id=$_estado_id;
        $pai->usuario_modificacion=$_user_id;
        $pai->update();

        return redirect()->route('pais.index')->with('message', 'Se actualizo con exito el Pais!.') ;


    }

    public function store(Request $request){

        $_nombre = $request->nombre;
        $_estado_id = $request->estado_id;

        Pais::create([
            'nombre' => $_nombre,
            'estado_id' => $_estado_id,
            'usuario_grabacion' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
        ]);
        $nuevo = 1;
        return redirect()->route('pais.index')->with('message', 'Se creo con exito el Pais!.') ;


    }





}
