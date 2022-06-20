<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlumnoRequest;
use App\Models\Alergia;
use App\Models\Alumno;
use App\Models\AlumnoDocumento;
use App\Models\AlumnoDocumentoConcepto;
use App\Models\Ciclo;
use App\Models\Encargado;
use App\Models\Enfermedad;
use App\Models\Grado;
use App\Models\LugarNacimiento;
use App\Models\Madre;
use App\Models\Padre;
use App\Models\Seguro;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {
        return view('alumno.index');
    }

    public function create()
    {
        $lugar_nacimiento = LugarNacimiento::where('estado_id', 1)->get();
        $seguro = Seguro::where('estado_id', 1)->get();
        $alergia = Alergia::where('estado_id', 1)->get();
        $grado = Grado::where('estado_id', 1)->get();
        $turno = Turno::where('estado_id', 1)->get();
        $enfermedad = Enfermedad::where('estado_id', 1)->get();
        $documento_concepto = AlumnoDocumentoConcepto::where('estado_id', 1)
        ->where('orden', '>', 0)
        ->orderBy('orden', 'ASC')
        ->get();

        return view('alumno.create',
        compact('lugar_nacimiento'
        , 'seguro'
        , 'alergia'
        , 'enfermedad'
        , 'grado'
        , 'turno'
        , 'documento_concepto'));
    }

    public function store(AlumnoRequest $request)
    {
        // dd($request->all());
        $cedula = str_replace('.', '' ,$request->cedula);
        $validar_cedula = Alumno::where('cedula', $cedula)
        ->where('estado_id', 1)
        ->first();
        $entregado = 0;
        $recibido =0;

        if(!empty($validar_cedula)){
            return redirect()->back()->with('msj', 'Ya existe alumno con este numero de cedula: '.$cedula);
        }

        $fecha_nacimiento_1 = $request->fecha_nacimiento;
        $foto_perfil = "";
        $date = Carbon::now();
        $fecha_nacimiento = date("d-m-Y",strtotime($request->fecha_nacimiento));
        $edad = date_diff(date_create($fecha_nacimiento), date_create($date));
        if($request->file('foto_perfil')){
            $filePath = $request->file('foto_perfil')->store('public/foto_perfil');
            $foto_perfil = $filePath;
        }
        $ciclo = Ciclo::where('nombre', date("Y",strtotime($date)))->first();
        $alumno = Alumno::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => $fecha_nacimiento_1,
            'edad' => $edad->y,
            'sexo' => $request->sexo,
            'madre_id' => $request->id_madre,
            'padre_id' => $request->id_padre,
            'cedula' => $cedula,
            'usuario_grabacion' => auth()->user()->id,
            'usuario_modificacion' => auth()->user()->id,
            'lugar_nacimiento_id' => $request->lugar_nacimiento,
            'telefono_baja' => $request->telefono_baja,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'alergia_id' => $request->alergia,
            'seguro_id' => $request->seguro,
            'cantidad_hermanos' => $request->cantidad_hermanos,
            'encargado_id' => $request->id_encargado,
            'estado_id' => 1,
            'foto_carnet' => 0,
            'certificado_nacimiento' => 0,
            'fotocopia_cedula' => 0,
            'fotocopia_cedula_padres' => 0,
            'certificado_nacimiento_copia' => 0,
            'libreta_vacunacion' => 0,
            'encargado_id_1' => $request->id_encargado1,
            'grado_id' => $request->grado,
            'turno_id' => $request->turno,
            'ciclo_id' => $ciclo->id,
            'encargado_id_2' => $request->id_encargado2,
            'encargado_id_3' => $request->id_encargado3,
            'foto' => $foto_perfil,
            'enfermedad_id' => $request->enfermedad,
            'observacion_enfermedad' => (empty($request->observacion_enfermedad) ? ' ' : $request->observacion_enfermedad),
        ]);


        $foto = $request->foto;
        $entregado = $request->recibido;
        $documento_concepto = AlumnoDocumentoConcepto::where('estado_id', 1)
        ->where('orden', '>', 0)
        ->orderBy('orden', 'ASC')
        ->get();

        for ($i = 0; $i < count($documento_concepto); $i++) {

            if(!empty($foto[$i])){

                $filePath = $foto[$i]->store('public/foto_documento');
                $foto_documento = $filePath;
                if(empty($entregado[$i])){
                    $recibido = 0;
                }else{
                    if($entregado[$i] == 1){
                        $recibido = 1;
                    }else{
                        $recibido = 0;
                    }
                }
                AlumnoDocumento::create([
                    'alumno_id' => $alumno->id,
                    'concepto_id' => $i + 1,
                    'imagen' => $foto_documento,
                    'recibido' => $recibido,
                    'usuario_grabacion' => auth()->user()->id,
                    'usuario_modificacion' => auth()->user()->id,
                ]);

            }
        }

        if(!empty($request->foto_madre)){
            $filePath = $request->foto_madre->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_madre)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_madre == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::create([
                'alumno_id' => $alumno->id,
                'concepto_id' => 5,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        if(!empty($request->foto_padre)){
            $filePath = $request->foto_padre->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_padre)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_padre == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::create([
                'alumno_id' => $alumno->id,
                'concepto_id' => 4,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        if(!empty($request->foto_encargado)){
            $filePath = $request->foto_encargado->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_encargado)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_encargado == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::create([
                'alumno_id' => $alumno->id,
                'concepto_id' => 8,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        if(!empty($request->foto_encargado1)){
            $filePath = $request->foto_encargado1->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_encargado1)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_encargado1 == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::create([
                'alumno_id' => $alumno->id,
                'concepto_id' => 9,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        if(!empty($request->foto_encargado2)){
            $filePath = $request->foto_encargado2->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_encargado2)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_encargado2 == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::create([
                'alumno_id' => $alumno->id,
                'concepto_id' => 10,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        if(!empty($request->foto_encargado3)){
            $filePath = $request->foto_encargado3->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_encargado3)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_encargado3 == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::create([
                'alumno_id' => $alumno->id,
                'concepto_id' => 11,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        return redirect()->route('alumno.index')->with('message', 'Se creo con exito el alumno!.');
    }

    public function edit(Alumno $alumno)
    {
        $lugar_nacimiento = LugarNacimiento::where('estado_id', 1)->get();
        $seguro = Seguro::where('estado_id', 1)->get();
        $alergia = Alergia::where('estado_id', 1)->get();
        $grado = Grado::where('estado_id', 1)->get();
        $turno = Turno::where('estado_id', 1)->get();
        $enfermedad = Enfermedad::where('estado_id', 1)->get();
        $documento_concepto = AlumnoDocumentoConcepto::where('estado_id', 1)
        ->where('orden', '>', 0)
        ->orderBy('orden', 'ASC')
        ->get();

        return view('alumno.edit',
        compact('alumno'
        , 'seguro'
        , 'alergia'
        , 'enfermedad'
        , 'grado'
        , 'turno'
        , 'lugar_nacimiento'
        , 'documento_concepto'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'cedula' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nacimiento' => 'required',
            'foto_perfil' => 'image|mimes:jpeg,png,jpg,gif',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_madre' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_padre' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_encargado' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_encargado1' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_encargado2' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_encargado3' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $fecha_nacimiento_1 = $request->fecha_nacimiento;
        $foto_perfil = "";
        $date = Carbon::now();
        $fecha_nacimiento = date("d-m-Y",strtotime($request->fecha_nacimiento));
        $edad = date_diff(date_create($fecha_nacimiento), date_create($date));
        if($request->file('foto_perfil')){

            $ant_doc_f = Storage::exists($alumno->foto);
            if($ant_doc_f){
                // Storage::delete($alumno->foto);
            }
            $filePath = $request->file('foto_perfil')->store('public/foto_perfil');
            $foto_perfil = $filePath;
        }else{
            $foto_perfil = $alumno->foto;
        }
        $cedula = $request->cedula;
        $alumno->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => $fecha_nacimiento_1,
            'edad' => $edad->y,
            'sexo' => $request->sexo,
            'madre_id' => $request->id_madre,
            'padre_id' => $request->id_padre,
            'cedula' => $cedula,
            'usuario_grabacion' => $alumno->usuario_grabacion,
            'usuario_modificacion' => auth()->user()->id,
            'lugar_nacimiento_id' => $request->lugar_nacimiento,
            'telefono_baja' => $request->telefono_baja,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'alergia_id' => $request->alergia,
            'seguro_id' => $request->seguro,
            'cantidad_hermanos' => $request->cantidad_hermanos,
            'encargado_id' => $request->id_encargado,
            'estado_id' => 1,
            'foto_carnet' => 0,
            'certificado_nacimiento' => 0,
            'fotocopia_cedula' => 0,
            'fotocopia_cedula_padres' => 0,
            'certificado_nacimiento_copia' => 0,
            'libreta_vacunacion' => 0,
            'encargado_id_1' => $request->id_encargado1,
            'grado_id' => $request->grado,
            'turno_id' => $request->turno,
            'encargado_id_2' => $request->id_encargado2,
            'encargado_id_3' => $request->id_encargado3,
            'foto' => $foto_perfil,
            'enfermedad_id' => $request->enfermedad,
            'observacion_enfermedad' => (empty($request->observacion_enfermedad) ? ' ' : $request->observacion_enfermedad),
        ]);

        $documento_concepto = AlumnoDocumentoConcepto::where('estado_id', 1)
        ->where('orden', '>', 0)
        ->orderBy('orden', 'ASC')
        ->get();
        $foto = $request->foto;
        $entregado = $request->recibido;

        for ($i = 0; $i < count($documento_concepto); $i++) {

            if(!empty($foto[$i])){

                $filePath = $foto[$i]->store('public/foto_documento');
                $foto_documento = $filePath;
                if(empty($entregado[$i])){
                    $recibido = 0;
                }else{
                    if($entregado[$i] == 1){
                        $recibido = 1;
                    }else{
                        $recibido = 0;
                    }
                }
                AlumnoDocumento::updateOrCreate([
                    'alumno_id' => $alumno->id,
                    'concepto_id' => $i + 1,
                ],
                [
                    'alumno_id' => $alumno->id,
                    'concepto_id' => $i + 1,
                    'imagen' => $foto_documento,
                    'recibido' => $recibido,
                    'usuario_grabacion' => auth()->user()->id,
                    'usuario_modificacion' => auth()->user()->id,
                ]);

            }
        }

        if(!empty($request->foto_madre)){
            $filePath = $request->foto_madre->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_madre)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_madre == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::updateOrCreate([
                'alumno_id' => $alumno->id,
                'concepto_id' => 5,
            ],
            [
                'alumno_id' => $alumno->id,
                'concepto_id' => 5,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        if(!empty($request->foto_padre)){
            $filePath = $request->foto_padre->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_padre)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_padre == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::updateOrCreate([
                'alumno_id' => $alumno->id,
                'concepto_id' => 4,
            ],
            [
                'alumno_id' => $alumno->id,
                'concepto_id' => 4,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        if(!empty($request->foto_encargado)){
            $filePath = $request->foto_encargado->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_encargado)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_encargado == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::updateOrCreate([
                'alumno_id' => $alumno->id,
                'concepto_id' => 8,
            ],
            [
                'alumno_id' => $alumno->id,
                'concepto_id' => 8,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        if(!empty($request->foto_encargado1)){
            $filePath = $request->foto_encargado1->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_encargado1)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_encargado1 == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::updateOrCreate([
                'alumno_id' => $alumno->id,
                'concepto_id' => 9,
            ],
            [
                'alumno_id' => $alumno->id,
                'concepto_id' => 9,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        if(!empty($request->foto_encargado2)){
            $filePath = $request->foto_encargado2->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_encargado2)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_encargado2 == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::updateOrCreate([
                'alumno_id' => $alumno->id,
                'concepto_id' => 10,
            ],
            [
                'alumno_id' => $alumno->id,
                'concepto_id' => 10,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        if(!empty($request->foto_encargado3)){
            $filePath = $request->foto_encargado3->store('public/foto_documento');
            $foto_documento = $filePath;
            if(empty($request->recibido_encargado3)){
                $entregado_1 = 0;
            }else{
                if($request->recibido_encargado3 == 1){
                    $entregado_1 = 1;
                }else{
                    $entregado_1 = 0;
                }
            }
            AlumnoDocumento::updateOrCreate([
                'alumno_id' => $alumno->id,
                'concepto_id' => 11,
            ],
            [
                'alumno_id' => $alumno->id,
                'concepto_id' => 11,
                'imagen' => $foto_documento,
                'recibido' => $entregado_1,
                'usuario_grabacion' => auth()->user()->id,
                'usuario_modificacion' => auth()->user()->id,
            ]);
        }

        return redirect()->route('alumno.index')->with('message', 'Se actualizo con exito el alumno!.');

    }

    public function madre_consulta(Request $request)
    {
        $cedula = str_replace('.', '', $request->cedula);

        $madre = Madre::where('cedula', $cedula)
        ->where('estado_id', 1)
        ->first();

        return response()->json($madre);
    }

    public function madre_crear(Request $request)
    {
        $cedula = str_replace('.', '', $request->cedula_madre);

        if(empty($cedula)){
            $data['mensaje'] = 'La cedula de la madre no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }


        if($cedula == 0){
            $data['mensaje'] = 'El numero de cedula no puede ser 0';
            $data['ok'] = 0;
            return response()->json($data);
        }else{
            $validar_cedula = Madre::where('cedula', $cedula)
            ->where('estado_id', 1)
            ->first();

            if(!empty($validar_cedula->cedula)){
                // $data['mensaje'] = 'Ya existe una persona con este numero de cedula: ' .$cedula .' - ' .$validar_cedula->nombre .$validar_cedula->apellido;
                // $data['ok'] = 0;
                // return response()->json($data);
                $data['id'] = $validar_cedula->id;
                $data['nombre'] = $validar_cedula->nombre;
                $data['apellido'] = $validar_cedula->apellido;
                $data['cedula'] = $validar_cedula->cedula;

                $data['mensaje'] = 'Guardado con exito!';
                $data['ok'] = 1;

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
            'cedula' => $cedula,
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
        $cedula = str_replace('.', '', $request->cedula);

        $padre = Padre::where('cedula', $cedula)
        ->where('estado_id', 1)
        ->first();

        return response()->json($padre);
    }

    public function padre_crear(Request $request)
    {

        $cedula = str_replace('.', '', $request->cedula_madre);

        if(empty($cedula)){
            $data['mensaje'] = 'La cedula del padre no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if($cedula == 0){
            $data['mensaje'] = 'El numero de cedula no puede ser 0';
            $data['ok'] = 0;
            return response()->json($data);
        }else{
            $validar_cedula = Padre::where('cedula', $cedula)
            ->where('estado_id', 1)
            ->first();

            if(!empty($validar_cedula->cedula)){
                // $data['mensaje'] = 'Ya existe una persona con este numero de cedula: ' .$cedula .' - ' .$validar_cedula->nombre .$validar_cedula->apellido;
                // $data['ok'] = 0;
                // return response()->json($data);
                $data['id'] = $validar_cedula->id;
                $data['nombre'] = $validar_cedula->nombre;
                $data['apellido'] = $validar_cedula->apellido;
                $data['cedula'] = $validar_cedula->cedula;

                $data['mensaje'] = 'Guardado con exito!';
                $data['ok'] = 1;

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
            'cedula' => $cedula,
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

        $cedula = str_replace('.', '', $request->cedula);
        $encargado = Encargado::where('cedula', $cedula)
        ->where('estado_id', 1)
        ->first();

        return response()->json($encargado);
    }

    public function encargado_crear(Request $request)
    {

        $cedula = str_replace('.', '', $request->cedula_madre);

        if(empty($cedula)){
            $data['mensaje'] = 'La cedula del encargado no puede estar vacio.';
            $data['ok'] = 0;
            return response()->json($data);
        }

        if($cedula == 0){
            $data['mensaje'] = 'El numero de cedula no puede ser 0';
            $data['ok'] = 0;
            return response()->json($data);
        }else{
            $validar_cedula = Encargado::where('cedula', $cedula)
            ->where('estado_id', 1)
            ->first();

            if(!empty($validar_cedula->cedula)){
                // $data['mensaje'] = 'Ya existe una persona con este numero de cedula: ' .$cedula .' - ' .$validar_cedula->nombre .$validar_cedula->apellido;
                // $data['ok'] = 0;
                // return response()->json($data);
                $data['id'] = $validar_cedula->id;
                $data['nombre'] = $validar_cedula->nombre;
                $data['cedula'] = $validar_cedula->cedula;

                $data['mensaje'] = 'Guardado con exito!';
                $data['ok'] = 1;

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
            'cedula' => $cedula,
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

    public function crear_datos(Request $request)
    {
        $id_aux = $request->id_aux;
        $data['nombre'] = $request->nombre_aux;
        $data['estado_id'] = 1;
        $data['usuario_grabacion'] = auth()->user()->id;
        $data['usuario_modificacion'] = auth()->user()->id;

        if($id_aux == 1){
            $data2 = LugarNacimiento::create($data);
            $data3 = LugarNacimiento::where('estado_id', 1)->get();
        }

        if($id_aux == 2){
            $data2 = Alergia::create($data);
            $data3 = Alergia::where('estado_id', 1)->get();
        }

        if($id_aux == 3){
            $data2 = Seguro::create($data);
            $data3 = Seguro::where('estado_id', 1)->get();
        }

        if($id_aux == 4){
            $data2 = Enfermedad::create($data);
            $data3 = Enfermedad::where('estado_id', 1)->get();
        }

        return response()->json($data3);
    }

}
