<?php

namespace App\Http\Controllers;

use App\Models\Alergia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlergiaController extends Controller
{
    //
    public function index(Request $request)
    {
        //consulta a la Base de Datos
        $alergias = Alergia::where('estado_id',1)->get();
        //esto es para ver que trae
        // dd($alergias);
        //para retornar a la vista
        return view('secundaria.alergia.index', compact('alergias'));
    }


    public function create(){

        return view('secundaria.alergia.create');

    }


    public function edit(Alergia $alergia){
        return view('secundaria.alergia.edit', compact('alergia'));
    }

    public function update(Request $request,Alergia $alergia){
        // return view('secundaria.alergia.edit', compact('alergia'));

        //sirve para ver que te trae el request.
        // dd($request->all());


        $_nombre=$request->nombre;
        $_estado_id=$request->estado_id;
        $_user_id =  auth()->user()->id;

        $alergia->nombre=$_nombre;
        $alergia->estado_id=$_estado_id;
        $alergia->usuario_modificacion=$_user_id;
        $alergia->update();

        return redirect()->route('alergia.index')->with('message', 'Se actualizo con exito la Alergia!.') ;


    }

    public function store(Request $request){

        $_nombre = $request->nombre;
        $_estado_id = $request->estado_id;

        Alergia::create([
            'nombre' => $_nombre,
            'estado_id' => $_estado_id,
            'usuario_grabacion' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
        ]);

        return redirect()->route('alergia.index')->with('message', 'Se creo con exito la Alergia!.') ;


    }





}
