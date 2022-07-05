<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:usuario.index')->only('index');
        $this->middleware('permission:usuario.create')->only('create');
        $this->middleware('permission:usuario.store')->only('store');
        $this->middleware('permission:usuario.show')->only('show');
        $this->middleware('permission:usuario.edit')->only('edit');
        $this->middleware('permission:usuario.update')->only('update');

        $this->middleware('permission:resetear_pass')->only('resetear_pass');
    }

    public function index()
    {
        $usuario = User::orderBy('id', 'DESC')->get();
        return view('usuario.index', compact('usuario'));
    }

    public function create()
    {
        return view('usuario.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('usuario.index')->with(['message' => 'Registro exitoso!']);
    }

    public function edit(User $usuario)
    {
        $role = Role::get();
        return view('usuario.edit', compact('usuario', 'role'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;

        $usuario->update($data);
        $usuario->syncRoles($request->rol);

        return redirect()->route('usuario.edit', $usuario)->with(['message' => 'Registro actualizado!']);

    }

    public function resetear_pass(User $usuario)
    {
        $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
        $usuario->password = bcrypt($password);
        $usuario->update();
        return redirect()->back()->with(['message' => 'Contraseña reseteada a: ' . $password])->withInput();
    }

    public function pass()
    {
        return view('usuario.show');
    }

    public function pass_store(Request $request)
    {
        $request->validate([
            'anterior' => 'required',
            'nuevo' => 'required'
        ]);

        if (Hash::check($request->input('anterior'),  auth()->user()->password)) {
            auth()->user()->update([
                'password' => bcrypt($request->nuevo),
            ]);
        }else{
            return redirect()->route('usuario.pass')->withInput()
            ->withErrors('La constraseña anterior no concuerda.');
        }

        return redirect()->route('usuario.pass')->with('message', 'Contraseña cambiado con exito.');
    }
}
