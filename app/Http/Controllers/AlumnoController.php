<?php

namespace App\Http\Controllers;

use App\Models\Alergia;
use App\Models\AlumnoDocumentoConcepto;
use App\Models\Encargado;
use App\Models\Grado;
use App\Models\LugarNacimiento;
use App\Models\Madre;
use App\Models\Padre;
use App\Models\Seguro;
use App\Models\Turno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {
        return view('alumno.index');
    }

    public function create()
    {
        $lugar_nacimiento = LugarNacimiento::all();
        $seguro = Seguro::all();
        $alergia = Alergia::all();
        $grado = Grado::all();
        $turno = Turno::all();
        $documento_concepto = AlumnoDocumentoConcepto::all();

        return view('alumno.create',
        compact('lugar_nacimiento'
        , 'seguro'
        , 'alergia'
        , 'grado'
        , 'turno'
        , 'documento_concepto'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function madre_consulta(Request $request)
    {
        $madre = Madre::where('cedula', $request->cedula)
        ->where('estado_id', 1)
        ->first();

        return response()->json($madre);
    }

    public function madre_crear(Request $request)
    {

        if(empty($request->cedula_madre)){
            $data['mensaje'] = 'La cedula de la madre no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }


        if($request->cedula_madre == 0){
            $data['mensaje'] = 'El numero de cedula no puede ser 0';
            $data['ok'] = 0;
            return response()->json($data);
        }else{
            $validar_cedula = Madre::where('cedula', $request->cedula_madre)
            ->where('estado_id', 1)
            ->first();

            if(!empty($validar_cedula->cedula)){
                $data['mensaje'] = 'Ya existe una persona con este numero de cedula: ' .$request->cedula_madre .' - ' .$validar_cedula->nombre .$validar_cedula->apellido;
                $data['ok'] = 0;
                return response()->json($data);
            }
        }

        if(empty($request->nombre_madre)){
            $data['mensaje'] = 'El nombre de la madre no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if(empty($request->apellido_madre)){
            $data['mensaje'] = 'El apellido de la madre no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if(empty($request->direccion)){
            $data['mensaje'] = 'La dirección no puede estar vacio.';
            $data['ok'] = 0;
        }

        $madre = Madre::create([
            'nombre' => $request->nombre_madre,
            'apellido' => $request->apellido_madre,
            'cedula' => $request->cedula_madre,
            'telefono_particular' => $request->telefono_particular,
            'telefono_wapp' => $request->telefono,
            'lugar_trabajo' => $request->lugar_trabajo,
            'direccion' => $request->direccion,
            'horario_dias_trabajo' => $request->dias_trabajo,
            'telefono_laboral' => $request->telefono_trabajo,
            'usuario_grabacion' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
            'estado_id' => 1,
            'tipo_documento_id' => 1,
        ]);

        $data['id'] = $madre->id;
        $data['nombre'] = $madre->nombre;
        $data['apellido'] = $madre->apellido;
        $data['cedula'] = $madre->cedula;

        $data['mensaje'] = 'Guardado con exito!';
        $data['ok'] = 1;

        return response()->json($data);

    }

    public function padre_consulta(Request $request)
    {
        $padre = Padre::where('cedula', $request->cedula)
        ->where('estado_id', 1)
        ->first();

        return response()->json($padre);
    }

    public function padre_crear(Request $request)
    {
        if(empty($request->cedula_madre)){
            $data['mensaje'] = 'La cedula del padre no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }


        if($request->cedula_madre == 0){
            $data['mensaje'] = 'El numero de cedula no puede ser 0';
            $data['ok'] = 0;
            return response()->json($data);
        }else{
            $validar_cedula = Padre::where('cedula', $request->cedula_madre)
            ->where('estado_id', 1)
            ->first();

            if(!empty($validar_cedula->cedula)){
                $data['mensaje'] = 'Ya existe una persona con este numero de cedula: ' .$request->cedula_madre .' - ' .$validar_cedula->nombre .$validar_cedula->apellido;
                $data['ok'] = 0;
                return response()->json($data);
            }
        }

        if(empty($request->nombre_madre)){
            $data['mensaje'] = 'El nombre de la padre no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if(empty($request->apellido_madre)){
            $data['mensaje'] = 'El apellido de la padre no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if(empty($request->direccion)){
            $data['mensaje'] = 'La dirección no puede estar vacio.';
            $data['ok'] = 0;
        }

        $padre = Padre::create([
            'nombre' => $request->nombre_madre,
            'apellido' => $request->apellido_madre,
            'cedula' => $request->cedula_madre,
            'telefono_particular' => $request->telefono_particular,
            'telefono_wapp' => $request->telefono,
            'lugar_trabajo' => $request->lugar_trabajo,
            'direccion' => $request->direccion,
            'horario_dias_trabajo' => $request->dias_trabajo,
            'telefono_laboral' => $request->telefono_trabajo,
            'usuario_grabacion' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
            'estado_id' => 1,
            'tipo_documento_id' => 1,
        ]);

        $data['id'] = $padre->id;
        $data['nombre'] = $padre->nombre;
        $data['apellido'] = $padre->apellido;
        $data['cedula'] = $padre->cedula;

        $data['mensaje'] = 'Guardado con exito!';
        $data['ok'] = 1;

        return response()->json($data);
    }

    public function encargado_consulta(Request $request)
    {
        $encargado = Encargado::where('cedula', $request->cedula)
        ->where('estado_id', 1)
        ->first();

        return response()->json($encargado);
    }

    public function encargado_crear(Request $request)
    {

        if(empty($request->cedula_madre)){
            $data['mensaje'] = 'La cedula del encargado no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if($request->cedula_madre == 0){
            $data['mensaje'] = 'El numero de cedula no puede ser 0';
            $data['ok'] = 0;
            return response()->json($data);
        }else{
            $validar_cedula = Encargado::where('cedula', $request->cedula_madre)
            ->where('estado_id', 1)
            ->first();

            if(!empty($validar_cedula->cedula)){
                $data['mensaje'] = 'Ya existe una persona con este numero de cedula: ' .$request->cedula_madre .' - ' .$validar_cedula->nombre .$validar_cedula->apellido;
                $data['ok'] = 0;
                return response()->json($data);
            }
        }

        if(empty($request->nombre_madre)){
            $data['mensaje'] = 'El nombre de la encargado no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }

        $encargado = Encargado::create([
            'nombre' => $request->nombre_madre,
            'cedula' => $request->cedula_madre,
            'telefono' => $request->telefono,
            'parentezco' => $request->parentezo,
            'usuario_grabacion' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
            'estado_id' => 1,
        ]);

        $data['id'] = $encargado->id;
        $data['nombre'] = $encargado->nombre;
        $data['cedula'] = $encargado->cedula;

        $data['mensaje'] = 'Guardado con exito!';
        $data['ok'] = 1;

        return response()->json($data);
    }

}
