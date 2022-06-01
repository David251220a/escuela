<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatriculaController extends Controller
{

    public function index(Request $request){
        return view('matricula.index');
    }

}
