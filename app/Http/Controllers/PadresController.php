<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Encargado;
use App\Models\Madre;
use App\Models\Padre;
use Illuminate\Http\Request;

class PadresController extends Controller
{
    public function editar_padres(Request $request)
    {
        $id = $request->id;
        if(empty($request->edit_cedula)){
            $data['mensaje'] = 'El numero de cedula no puede quedar vacio!';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if(empty($request->edit_nombre)){
            $data['mensaje'] = 'El nombre no puede quedar vacio!';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if(empty($request->edit_apellido)){
            $data['mensaje'] = 'El apellido no puede quedar vacio!';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if(empty($request->edit_direccion)){
            $data['mensaje'] = 'La direccion no puede quedar vacio!';
            $data['ok'] = 0;
            return response()->json($data);
        }
        if($id == 1){
            $padre = Padre::find($request->edit_id);
            $padre->update([
                'nombre' => $request->edit_nombre,
                'apellido' => $request->edit_apellido,
                'cedula' => str_replace('.', '', $request->edit_cedula),
                'telefono_particular' => $request->edit_telef_particular,
                'telefono_wapp' => $request->edit_telefono,
                'lugar_trabajo' => $request->edit_trabajo,
                'direccion' => $request->edit_direccion,
                'horario_dias_trabajo' => $request->edit_dias,
                'telefono_laboral' => $request->edit_telef_laboral,
                'usuario_modificacion' => auth()->user()->id,
            ]);

            $data['id'] = $padre->id;
            $data['nombre'] = $padre->nombre;
            $data['apellido'] = $padre->apellido;
            $data['cedula'] = $padre->cedula;
            $data['telefono_particular'] = $padre->telefono_particular;
            $data['telefono_wapp'] = $padre->telefono_wapp;
            $data['lugar_trabajo'] = $padre->lugar_trabajo;
            $data['direccion'] = $padre->direccion;
            $data['horario_dias_trabajo'] = $padre->horario_dias_trabajo;
            $data['telefono_laboral'] = $padre->telefono_laboral;
            $data['padres'] = 1;
        }

        if($id == 2){
            $madre = Madre::find($request->edit_id);
            $madre->update([
                'nombre' => $request->edit_nombre,
                'apellido' => $request->edit_apellido,
                'cedula' => str_replace('.', '', $request->edit_cedula),
                'telefono_particular' => $request->edit_telef_particular,
                'telefono_wapp' => $request->edit_telefono,
                'lugar_trabajo' => $request->edit_trabajo,
                'direccion' => $request->edit_direccion,
                'horario_dias_trabajo' => $request->edit_dias,
                'telefono_laboral' => $request->edit_telef_laboral,
                'usuario_modificacion' => auth()->user()->id,
            ]);

            $data['id'] = $madre->id;
            $data['nombre'] = $madre->nombre;
            $data['apellido'] = $madre->apellido;
            $data['cedula'] = $madre->cedula;
            $data['telefono_particular'] = $madre->telefono_particular;
            $data['telefono_wapp'] = $madre->telefono_wapp;
            $data['lugar_trabajo'] = $madre->lugar_trabajo;
            $data['direccion'] = $madre->direccion;
            $data['horario_dias_trabajo'] = $madre->horario_dias_trabajo;
            $data['telefono_laboral'] = $madre->telefono_laboral;
            $data['padres'] = 2;
        }

        $data['mensaje'] = 'Actualizado con Exito!!';
        $data['ok'] = 1;
        return response()->json($data);
    }

    public function editar_encargado(Request $request)
    {
        $cedula = str_replace('.', '', $request->cedula);

        if(empty($cedula)){
            $data['mensaje'] = 'La cedula del encargado no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if($cedula == 0){
            $data['mensaje'] = 'El numero de cedula no puede ser 0';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if(empty($request->nombre)){
            $data['mensaje'] = 'El nombre de la encargado no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }

        $encargado = Encargado::find($request->edit_id);

        $encargado->update([
            'nombre' => $request->nombre,
            'cedula' => $cedula,
            'telefono' => $request->telefono,
            'parentezco' => $request->parentezo,
            'observacion' => $request->observacion_encargado,
            'usuario_modificacion' => auth()->user()->id,
        ]);

        $data['id'] = $encargado->id;
        $data['nombre'] = $encargado->nombre;
        $data['cedula'] = $encargado->cedula;

        $data['mensaje'] = 'Actualizado con Exito!!';
        $data['ok'] = 1;

        return response()->json($data);
    }
}
