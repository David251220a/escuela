<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PadreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:padre.index')->only('index');
        $this->middleware('permission:padre.create')->only('create');
        $this->middleware('permission:padre.edit')->only('edit');

    }

    public function index(){
        $titulo = 'Padre';
        return view('padres.index', compact('titulo'));
    }
}
