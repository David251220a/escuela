<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GrupoUsuarioController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:rol.index')->only('index');
        // $this->middleware('permission:rol.create')->only('create');
        // $this->middleware('permission:rol.store')->only('store');
        // $this->middleware('permission:rol.show')->only('show');
        // $this->middleware('permission:rol.edit')->only('edit');
        // $this->middleware('permission:rol.update')->only('update');
    }

    public function index()
    {
        $data = Role::get();
        return view('grupo_usuario.index', compact('data'));
    }

    public function create()
    {
        return view('grupo_usuario.create');
    }

    public function store(Request $request)
    {
        Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        return redirect()->route('rol.index')->with(['message' => 'Registro exitoso!']);
    }

    public function edit(Role $rol)
    {
        $permisos = Permission::orderBy('name')->get();
        return view('grupo_usuario.edit', compact('rol', 'permisos'));
    }

    public function update(Request $request, Role $rol)
    {
        $rol->syncPermissions($request->permissions);
        $rol->name = $request->name;
        $rol->save();
        return redirect()->route('rol.index')->with(['message' => 'Registro exitoso!']);
    }

}
