<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MadreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:madre.index')->only('index');
        $this->middleware('permission:madre.create')->only('create');
        $this->middleware('permission:madre.edit')->only('edit');

    }

    public function index(Request $request)
    {
        $titulo = 'Madre';
        return view('padres.index', compact('titulo'));
    }

}
