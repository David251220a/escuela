<?php

namespace App\Http\Controllers;

use App\Models\Enfermedad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnfermedadController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:enfermedad.index')->only('index');
        $this->middleware('permission:enfermedad.create')->only('create');
        $this->middleware('permission:enfermedad.store')->only('store');
        $this->middleware('permission:enfermedad.show')->only('show');
        $this->middleware('permission:enfermedad.edit')->only('edit');
        $this->middleware('permission:enfermedad.update')->only('update');
    }

    public function index(Request $request)
    {
        //consulta a la Base de Datos
        $enfermedad = Enfermedad::where('estado_id',1)->get();
        //esto es para ver que trae
        // dd($alergias);
        //para retornar a la vista
        return view('secundaria.enfermedad.index', compact('enfermedad'));
    }


    public function create(){

        return view('secundaria.enfermedad.create');

    }


    public function edit(Enfermedad $enfermedad){
        return view('secundaria.enfermedad.edit', compact('enfermedad'));
    }

    public function update(Request $request,Enfermedad $enfermedad){
        // return view('secundaria.alergia.edit', compact('alergia'));

        //sirve para ver que te trae el request.
        // dd($request->all());


        $_nombre=$request->nombre;
        $_estado_id=$request->estado_id;
        $_user_id =  auth()->user()->id;

        $enfermedad->nombre=$_nombre;
        $enfermedad->estado_id=$_estado_id;
        $enfermedad->usuario_modificacion=$_user_id;
        $enfermedad->update();

        return redirect()->route('enfermedad.index')->with('message', 'Se actualizo con exito la Enfermedad!.') ;


    }

    public function store(Request $request){

        $_nombre = $request->nombre;
        $_estado_id = $request->estado_id;

        Enfermedad::create([
            'nombre' => $_nombre,
            'estado_id' => $_estado_id,
            'usuario_grabacion' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
        ]);

        return redirect()->route('enfermedad.index')->with('message', 'Se creo con exito la Enfermedad!.') ;


    }





}
