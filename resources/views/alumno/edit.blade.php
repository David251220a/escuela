<x-app-layout>

    <h2 class="text-xl text-gray-500 font-semibold mb-2">Actualizar Alumno: {{$alumno->nombre}} {{$alumno->apellido}}</h2>

    <form action="{{ route('alumno.update', $alumno) }}" method="POST" enctype="multipart/form-data" novalidate>
        @method('PUT')
        @csrf

        <div class="mb-4 mt-4 text-center">
            <img
                src="{{ Storage::url($alumno->foto) }}"
                class="rounded-full w-32 h-32 mb-4 mx-auto"
                style="style=height: 168px; width: 168px"
                alt="Avatar"
                id="avatar"
            />

            <p onclick="cambio()" class="text-xl font-medium leading-tight mb-2">Agregar Foto</p>
            <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*" hidden>

        </div>

        <div class="mb-4 border-b border-gray-200">

            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                    id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                        <i class="fas fa-comment-dollar mr-1 mt-1"></i>
                        Alumno
                        </button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                        <i class="fas fa-calculator mr-1 mt-1"></i>
                        Padres
                    </button>
                </li>

                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="documento_alumno-tab" data-tabs-target="#documento_alumno" type="button" role="tab" aria-controls="documento_alumno" aria-selected="false">
                        <i class="fas fa-calculator mr-1 mt-1"></i>
                        Documentos del Alumno
                    </button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">

            <div class="hidden p-1 rounded-lg" id="profile" role="tabpanel" aria-labelledby="dashboard-tab">

                <div class="bg-white rounded overflow-hidden shadow mb-4">

                    <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

                        <div class="mb-4">
                            <label for="">Cedula</label>
                            <input type="text" name="cedula" id="cedula"  class="w-full rounded border-gray-400 enviar" value="{{$alumno->cedula}}"  >
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="w-full rounded border-gray-400 enviar" value="{{$alumno->nombre}}">
                        </div>

                        <div class="mb-4">
                            <label for="">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="w-full rounded border-gray-400 enviar" value="{{$alumno->apellido}}">
                        </div>

                        <div class="mb-4">
                            <label for="">Fecha Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="w-full rounded border-gray-400 enviar" value="{{$alumno->fecha_nacimiento}}">
                        </div>

                        <div class="mb-4">
                            <label for="">Sexo</label>
                            <select name="sexo" id="sexo" class="w-full rounded border-gray-400 enviar">
                                <option {{($alumno->sexo == 1 ? 'selected' : '')}} value="1">MASCULINO</option>
                                <option {{($alumno->sexo == 2 ? 'selected' : '')}}  value="2">FEMENINO</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="">Lugar Nacimiento</label>
                            <select name="lugar_nacimiento" id="lugar_nacimiento" class="w-full rounded border-gray-400 enviar">

                                @foreach ($lugar_nacimiento as $item)
                                    <option {{($alumno->lugar_nacimiento_id == $item->id ? 'selected' : '')}} value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="">Telefono Baja</label>
                            <input type="text" name="telefono_baja" id="telefono_baja" class="w-full rounded border-gray-400 enviar" value="{{$alumno->telefono_baja}}">
                        </div>

                        <div class="mb-4">
                            <label for="">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="w-full rounded border-gray-400 enviar" value="{{$alumno->telefono}}">
                        </div>

                        <div class="mb-4">
                            <label for="">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="w-full rounded border-gray-400 enviar" value="{{$alumno->direccion}}">
                        </div>

                        <div class="mb-4">
                            <label for="">Alergia</label>
                            <select name="alergia" id="alergia" class="w-full rounded border-gray-400 enviar">
                                @foreach ($alergia as $item1)
                                    <option {{($alumno->alergia_id == $item1->id ? 'selected' : '')}} value="{{ $item1->id }}">{{ $item1->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="">Seguro</label>
                            <select name="seguro" id="seguro" class="w-full rounded border-gray-400 enviar">
                                @foreach ($seguro as $item)
                                    <option {{($alumno->seguro_id == $item->id ? 'selected' : '')}} value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="">Cantidad de Hermanos</label>
                            <input type="number" name="cantidad_hermanos" id="cantidad_hermanos" class="w-full rounded border-gray-400 enviar" value="{{$alumno->cantidad_hermanos}}">
                        </div>

                        <div class="mb-4">
                            <label for="">Grado</label>
                            <select name="grado" id="grado" class="w-full rounded border-gray-400 enviar">
                                @foreach ($grado as $item)
                                    <option {{($alumno->grado_id == $item->id ? 'selected' : '')}} value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="">Turno</label>
                            <select name="turno" id="turno" class="w-full rounded border-gray-400 enviar">
                                @foreach ($turno as $item)
                                    <option {{($alumno->turno_id == $item->id ? 'selected' : '')}} value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>
            </div>

            <div class="hidden p-1 rounded-lg" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">

                <div class="bg-white rounded overflow-hidden shadow mb-4">

                    <div class="md:grid grid-cols-4 gap-4 px-4 py-6">
                        <div class="mb-4">
                            <label for="">Cedula Madre</label>
                            <input type="text" name="cedula_madre" id="cedula_madre" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->madre->cedula }}">
                            <input type="hidden" name="id_madre" id="id_madre" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->madre->id }}">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Madre</label>
                            <input type="text" name="nombre_madre" id="nombre_madre" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->madre->nombre }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="">Cedula Padre</label>
                            <input type="text" name="cedula_padre" id="cedula_padre" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->padre->cedula }}">
                            <input type="hidden" name="id_padre" id="id_padre" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->padre->id }}">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Padre</label>
                            <input type="text" name="nombre_padre" id="nombre_padre" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->padre->nombre }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="">Cedula Encargado</label>
                            <input type="text" name="cedula_encargado" id="cedula_encargado" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado->cedula }}">
                            <input type="hidden" name="id_encargado" id="id_encargado" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado->id }}">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Encargado</label>
                            <input type="text" name="nombre_encargado" id="nombre_encargado" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado->nombre }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="">Cedula Encargado 1</label>
                            <input type="text" name="cedula_encargado1" id="cedula_encargado1" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado1->cedula }}">
                            <input type="hidden" name="id_encargado1" id="id_encargado1" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado1->id }}">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Encargado 1</label>
                            <input type="text" name="nombre_encargado1" id="nombre_encargado1" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado1->nombre }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="">Cedula Encargado 2</label>
                            <input type="text" name="cedula_encargado2" id="cedula_encargado2" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado2->cedula }}">
                            <input type="hidden" name="id_encargado2" id="id_encargado2" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado2->id }}">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Encargado 2</label>
                            <input type="text" name="nombre_encargado2" id="nombre_encargado2" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado2->nombre }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="">Cedula Encargado 3</label>
                            <input type="text" name="cedula_encargado3" id="cedula_encargado3" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado3->cedula }}">
                            <input type="hidden" name="id_encargado3" id="id_encargado3" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado3->id }}">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Encargado 3</label>
                            <input type="text" name="nombre_encargado3" id="nombre_encargado3" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->encargado3->nombre }}" readonly>
                        </div>

                    </div>

                </div>

            </div>

            <div class="hidden p-1 rounded-lg" id="documento_alumno" role="tabpanel" aria-labelledby="documento_alumno-tab">
                <div class="bg-white rounded overflow-hidden shadow mb-4">
                    <h2 class="text-gray-500 text-center font-semibold text-xl">Documentos Presentados</h2>
                    <div class="md:grid grid-cols-2 gap-4 px-4 py-6">

                        @foreach ($alumno->documentos as $item)
                            <div class="form-check mb-4">
                                <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="" id="flexCheckChecked" checked readonly>
                                <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">
                                   {{$item->concepto->nombre}} - <a href="{{ Storage::url($item->imagen) }}" target="__blank"><i class='bx bx-image-alt'></i> Ver</a>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded overflow-hidden shadow mb-4">

                    <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

                        @foreach ($documento_concepto as $concepto)

                            <div class="col-span-2 mb-4">
                                @foreach ($documento_concepto as $item)

                                    @if ($item->id == $concepto->id)
                                        {{-- <option value="{{ $item->id }}">{{ $item->nombre }}</option> --}}
                                        <label for="">Concepto</label>
                                        <input type="text" name="documento_concepto" id="documento_concepto" class="w-full rounded border-gray-400 enviar" value="{{ $item->nombre }}" readonly >
                                    @endif

                                @endforeach
                            </div>
                            <div class="col-span-2 mb-4">
                                <label for="">Foto Documento</label>
                                <input type="file" name="foto[]" id="foto[]" class="w-full rounded border-gray-400 enviar" accept="image/*">
                            </div>

                        @endforeach

                    </div>

                    <div class="mb-4 pl-4">
                        <button type="submit"
                        class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded
                        shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700
                        active:shadow-lg transition duration-150 ease-in-out"
                         value="">Guardar</button>
                    </div>

                </div>
            </div>

        </div>

    </div>

    </form>

    {{-- PARA CREAR A LA MADRE --}}

    <div hidden id="madre_formulario">

        <div class="bg-white rounded overflow-hidden shadow mb-4">

            <div class="md:grid grid-cols-2 gap-4 px-4 py-6">

                <div class="mb-4">
                    <label for="">Cedula</label>
                    <input type="text" name="cedula_madre_aux" id="cedula_madre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre_madre_aux" id="nombre_madre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Apellido</label>
                    <input type="text" name="apellido_madre_aux" id="apellido_madre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Telefono Particular</label>
                    <input type="text" name="telefono_particular_madre_aux" id="telefono_particular_madre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Telefono</label>
                    <input type="text" name="telefono_madre_aux" id="telefono_madre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Direccion</label>
                    <input type="text" name="direccion_madre_aux" id="direccion_madre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Lugar de Trabajo</label>
                    <input type="text" name="trabajo_madre_aux" id="trabajo_madre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Dias de Trabajo</label>
                    <input type="text" name="dias_trabajo_madre_aux" id="dias_trabajo_madre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Telefono Laboral</label>
                    <input type="text" name="telefono_trabajo_madre_aux" id="telefono_trabajo_madre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

            </div>

        </div>

    </div>

    {{-- PARA CREAR AL PADRE --}}
    <div hidden id="padre_formulario">

        <div class="bg-white rounded overflow-hidden shadow mb-4">

            <div class="md:grid grid-cols-2 gap-4 px-4 py-6">

                <div class="mb-4">
                    <label for="">Cedula</label>
                    <input type="text" name="cedula_padre_aux" id="cedula_padre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre_padre_aux" id="nombre_padre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Apellido</label>
                    <input type="text" name="apellido_padre_aux" id="apellido_padre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Telefono Particular</label>
                    <input type="text" name="telefono_particular_padre_aux" id="telefono_particular_padre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Telefono</label>
                    <input type="text" name="telefono_padre_aux" id="telefono_padre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Direccion</label>
                    <input type="text" name="direccion_padre_aux" id="direccion_padre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Lugar de Trabajo</label>
                    <input type="text" name="trabajo_padre_aux" id="trabajo_padre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Dias de Trabajo</label>
                    <input type="text" name="dias_trabajo_padre_aux" id="dias_trabajo_padre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Telefono Laboral</label>
                    <input type="text" name="telefono_trabajo_padre_aux" id="telefono_trabajo_padre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

            </div>

        </div>

    </div>

    {{-- PARA CREAR AL ENCARGADO --}}
    <div hidden id="encargado_formulario">

        <div class="bg-white rounded overflow-hidden shadow mb-4">

            <div class="md:grid grid-cols-2 gap-4 px-4 py-6">

                <div class="mb-4">
                    <label for="">Cedula</label>
                    <input type="text" name="cedula_encargado_aux" id="cedula_encargado_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Nombre</label>
                    <input type="text" name="encargado_nombre_aux" id="encargado_nombre_aux" class="w-full rounded border-gray-400 enviar">
                </div>

                <div class="mb-4">
                    <label for="">Parentezco</label>
                    <select name="encargado_parentezco" id="encargado_parentezco" class="w-full rounded border-gray-400 enviar">
                        <option value="SIN ESPECIFICAR">SIN ESPECIFICAR</option>
                        <option value="HERMANO/A">HERMANO/A</option>
                        <option value="TIO/A">TIO/A</option>
                        <option value="ABUELO/A">ABUELO/A</option>
                        <option value="PADRASTRO">PADRASTRO</option>
                        <option value="MADRASTRA">MADRASTRA</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="">Telefono</label>
                    <input type="text" name="telefono_encargado_aux" id="telefono_encargado_aux" class="w-full rounded border-gray-400 enviar">
                </div>

            </div>

        </div>

    </div>

    {{-- PARA CARGAR DEMAS DATOS : ALERGIA , LUGAR NACIMIENTO SEGURO  --}}
    <div hidden id="datos_formulario">

        <div class="bg-white rounded overflow-hidden shadow mb-4">

            <div class="mb-4">
                <label for="">Nombre</label>
                <input type="text" name="nombre_tipo_aux" id="nombre_tipo_aux" class="w-full rounded border-gray-400 enviar">
            </div>

        </div>
    </div>

    <script>

        const foto_perfil = document.getElementById('foto_perfil');
        foto_perfil.addEventListener('change', mostrarImagen, false);

        var element = document.querySelectorAll('.enviar');
        document.addEventListener('keydown', (event) => {
            const keyName = event.key;

            if (event.keyCode == 13) {
                event.preventDefault();
                if(event.target.id == 'cedula_madre'){
                    cedula = document.getElementById('cedula_madre').value;
                    if(cedula == 0){
                        document.getElementById('id_madre').value = 1;
                        document.getElementById('nombre_madre').value = 'SIN ESPECIFICAR';
                    }else{
                        axios.post('/madre_consulta',  {
                            cedula : cedula
                        })
                        .then(respuesta => {
                            if(JSON.stringify(respuesta.data)=='{}'){
                                crear_madre();
                            }else{
                                document.getElementById('id_madre').value = respuesta.data.id;
                                document.getElementById('nombre_madre').value = respuesta.data.nombre + ' '+ respuesta.data.apellido;
                            }
                        })
                        .catch(error => {
                            console.log(error);

                        })
                    }

                }

                if(event.target.id == 'cedula_padre'){
                    cedula = document.getElementById('cedula_padre').value;
                    if(cedula == 0){
                        document.getElementById('id_padre').value = 1;
                        document.getElementById('nombre_padre').value = 'SIN ESPECIFICAR';
                    }else{
                        axios.post('/padre_consulta',  {
                            cedula : cedula
                        })
                        .then(respuesta => {
                            if(JSON.stringify(respuesta.data)=='{}'){
                                crear_padre();
                            }else{
                                document.getElementById('id_padre').value = respuesta.data.id;
                                document.getElementById('nombre_padre').value = respuesta.data.nombre + ' '+ respuesta.data.apellido;
                            }
                        })
                        .catch(error => {
                            console.log(error);

                        })
                    }

                }

                if(event.target.id == 'cedula_encargado'){
                    cedula = document.getElementById('cedula_encargado').value;
                    if(cedula == 0){
                        document.getElementById('id_encargado').value = 1;
                        document.getElementById('nombre_encargado').value = 'SIN ESPECIFICAR';
                    }else{
                        axios.post('/encargado_consulta',  {
                            cedula : cedula
                        })
                        .then(respuesta => {
                            if(JSON.stringify(respuesta.data)=='{}'){
                                crear_encargado(1);
                            }else{
                                document.getElementById('id_encargado').value = respuesta.data.id;
                                document.getElementById('nombre_encargado').value = respuesta.data.nombre;
                            }
                        })
                        .catch(error => {
                            console.log(error);

                        })
                    }

                }

                if(event.target.id == 'cedula_encargado1'){
                    cedula = document.getElementById('cedula_encargado1').value;
                    if(cedula == 0){
                        document.getElementById('id_encargado1').value = 1;
                        document.getElementById('nombre_encargado1').value = 'SIN ESPECIFICAR';
                    }else{
                        axios.post('/encargado_consulta',  {
                            cedula : cedula
                        })
                        .then(respuesta => {
                            if(JSON.stringify(respuesta.data)=='{}'){
                                crear_encargado(2);
                            }else{
                                document.getElementById('id_encargado1').value = respuesta.data.id;
                                document.getElementById('nombre_encargado1').value = respuesta.data.nombre;
                            }
                        })
                        .catch(error => {
                            console.log(error);

                        })
                    }

                }

                if(event.target.id == 'cedula_encargado2'){
                    cedula = document.getElementById('cedula_encargado2').value;
                    if(cedula == 0){
                        document.getElementById('id_encargado2').value = 1;
                        document.getElementById('nombre_encargado2').value = 'SIN ESPECIFICAR';
                    }else{
                        axios.post('/encargado_consulta',  {
                            cedula : cedula
                        })
                        .then(respuesta => {
                            if(JSON.stringify(respuesta.data)=='{}'){
                                crear_encargado(3);
                            }else{
                                document.getElementById('id_encargado2').value = respuesta.data.id;
                                document.getElementById('nombre_encargado2').value = respuesta.data.nombre;
                            }
                        })
                        .catch(error => {
                            console.log(error);

                        })
                    }

                }

                if(event.target.id == 'cedula_encargado3'){
                    cedula = document.getElementById('cedula_encargado3').value;
                    if(cedula == 0){
                        document.getElementById('id_encargado3').value = 1;
                        document.getElementById('nombre_encargado3').value = 'SIN ESPECIFICAR';
                    }else{
                        axios.post('/encargado_consulta',  {
                            cedula : cedula
                        })
                        .then(respuesta => {
                            if(JSON.stringify(respuesta.data)=='{}'){
                                crear_encargado(4);
                            }else{
                                document.getElementById('id_encargado3').value = respuesta.data.id;
                                document.getElementById('nombre_encargado3').value = respuesta.data.nombre;
                            }
                        })
                        .catch(error => {
                            console.log(error);

                        })
                    }

                }

            }

            if(event.keyCode == 113){
                id_aux = 0;
                if(event.target.id == 'lugar_nacimiento'){
                    id_aux = 1;
                    titulo = 'Agregar Lugar Nacimiento';
                    select = document.getElementById('lugar_nacimiento');
                }

                if(event.target.id == 'alergia'){
                    id_aux = 2;
                    titulo = 'Agregar Alergia';
                    select = document.getElementById('alergia');

                }

                if(event.target.id == 'seguro'){
                    id_aux = 3;
                    titulo = 'Agregar Seguro';
                    select = document.getElementById('seguro');

                }
                var siguiente = document.getElementById('datos_formulario').innerHTML;
                if(parseInt(id_aux) == 0){

                }else{

                    Swal.fire({
                        title: titulo,
                        html:
                        siguiente,
                        width: 600,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Guardar',

                    }).then(resultado => {
                        if (resultado.value) {
                            var nombre_aux = Swal.getPopup().querySelector('#nombre_tipo_aux').value;
                            axios.post('/crear_datos',  {
                                nombre_aux : nombre_aux,
                                id_aux : id_aux
                            })
                            .then(respuesta => {
                                for (let i = select.options.length; i >= 0; i--) {
                                    select.remove(i);
                                }

                                for(var i=0; i < respuesta.data.length; i++){
                                    var option = document.createElement('option');
                                    var valor = respuesta.data[i].id;
                                    var valor2 = respuesta.data[i].nombre;
                                    option.value = valor;
                                    option.text = valor2;
                                    select.appendChild(option);
                                }
                            })
                            .catch(error => {
                                console.log(error);
                            })

                        }

                    })

                }

            }
        });

        function mostrarImagen(event) {
            var formData = new FormData();
            var imagefile = document.querySelector('#foto_perfil');
            formData.append("foto_perfil", imagefile.files[0]);

            var doc_v = event.target.files[0];

            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function(event) {
                var img = document.getElementById('avatar');
                img.src= event.target.result;
            }
            reader.readAsDataURL(file);

        }


        function cambio(){
            $('#foto_perfil').click();
        }

        function crear_madre(){

            Swal.fire({
                title: 'Desea crear datos para la Madre?',
                text: "No existe coincidencia con este numero de cedula!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then(resultado => {
                if (resultado.value) {
                    var siguiente = document.getElementById('madre_formulario').innerHTML;
                    Swal.fire({
                        title: '<u>Datos de la Madre</u>',
                        html:
                        siguiente,
                        width: 800,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Guardar',

                        }).then(resultado => {
                            if (resultado.value) {
                                var cedula_madre = Swal.getPopup().querySelector('#cedula_madre_aux').value;
                                var nombre_madre = Swal.getPopup().querySelector('#nombre_madre_aux').value;
                                var apellido_madre = Swal.getPopup().querySelector('#apellido_madre_aux').value;
                                var telefono_particular = Swal.getPopup().querySelector('#telefono_particular_madre_aux').value;
                                var telefono = Swal.getPopup().querySelector('#telefono_madre_aux').value;
                                var direccion = Swal.getPopup().querySelector('#direccion_madre_aux').value;
                                var lugar_trabajo = Swal.getPopup().querySelector('#trabajo_madre_aux').value;
                                var dias_trabajo = Swal.getPopup().querySelector('#dias_trabajo_madre_aux').value;
                                var telefono_trabajo = Swal.getPopup().querySelector('#telefono_trabajo_madre_aux').value;

                                axios.post('/madre_crear',  {
                                    cedula_madre : cedula_madre,
                                    nombre_madre : nombre_madre,
                                    apellido_madre : apellido_madre,
                                    telefono_particular : telefono_particular,
                                    telefono : telefono,
                                    direccion : direccion,
                                    lugar_trabajo : lugar_trabajo,
                                    dias_trabajo : dias_trabajo,
                                    telefono_trabajo : telefono_trabajo,
                                })
                                .then(respuesta => {
                                    if(respuesta.data.ok == 1){
                                        document.getElementById('id_madre').value = respuesta.data.id;
                                        document.getElementById('cedula_madre').value = respuesta.data.cedula;
                                        document.getElementById('nombre_madre').value = respuesta.data.nombre +' '+respuesta.data.apellido;
                                        Swal.fire(
                                            'Datos de la Madre',
                                            respuesta.data.mensaje,
                                            'success'
                                        )
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: respuesta.data.mensaje,
                                        })
                                    }

                                })
                                .catch(error => {
                                    console.log(error);
                                })
                            }

                        })
                    }
                })
        }

        function crear_padre(){

            Swal.fire({
                title: 'Desea crear datos para el padre?',
                text: "No existe coincidencia con este numero de cedula!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then(resultado => {
                if (resultado.value) {
                    var siguiente = document.getElementById('padre_formulario').innerHTML;
                    Swal.fire({
                        title: '<u>Datos del Padre</u>',
                        html:
                        siguiente,
                        width: 800,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Guardar',

                        }).then(resultado => {
                            if (resultado.value) {
                                var cedula_madre = Swal.getPopup().querySelector('#cedula_padre_aux').value;
                                var nombre_madre = Swal.getPopup().querySelector('#nombre_padre_aux').value;
                                var apellido_madre = Swal.getPopup().querySelector('#apellido_padre_aux').value;
                                var telefono_particular = Swal.getPopup().querySelector('#telefono_particular_padre_aux').value;
                                var telefono = Swal.getPopup().querySelector('#telefono_padre_aux').value;
                                var direccion = Swal.getPopup().querySelector('#direccion_padre_aux').value;
                                var lugar_trabajo = Swal.getPopup().querySelector('#trabajo_padre_aux').value;
                                var dias_trabajo = Swal.getPopup().querySelector('#dias_trabajo_padre_aux').value;
                                var telefono_trabajo = Swal.getPopup().querySelector('#telefono_trabajo_padre_aux').value;

                                axios.post('/padre_crear',  {
                                    cedula_madre : cedula_madre,
                                    nombre_madre : nombre_madre,
                                    apellido_madre : apellido_madre,
                                    telefono_particular : telefono_particular,
                                    telefono : telefono,
                                    direccion : direccion,
                                    lugar_trabajo : lugar_trabajo,
                                    dias_trabajo : dias_trabajo,
                                    telefono_trabajo : telefono_trabajo,
                                })
                                .then(respuesta => {
                                    if(respuesta.data.ok == 1){
                                        document.getElementById('id_padre').value = respuesta.data.id;
                                        document.getElementById('cedula_padre').value = respuesta.data.cedula;
                                        document.getElementById('nombre_padre').value = respuesta.data.nombre +' '+respuesta.data.apellido;
                                        Swal.fire(
                                            'Datos del Padre',
                                            respuesta.data.mensaje,
                                            'success'
                                        )
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: respuesta.data.mensaje,
                                        })
                                    }

                                })
                                .catch(error => {
                                    console.log(error);
                                })
                            }

                        })
                    }
                })
        }

        function crear_encargado(encar){

            Swal.fire({
                title: 'Desea crear datos para el encargado?',
                text: "No existe coincidencia con este numero de cedula!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then(resultado => {
                if (resultado.value) {
                    var siguiente = document.getElementById('encargado_formulario').innerHTML;
                    Swal.fire({
                        title: '<u>Datos del Encargado</u>',
                        html:
                        siguiente,
                        width: 800,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Guardar',

                        }).then(resultado => {
                            if (resultado.value) {
                                var cedula_madre = Swal.getPopup().querySelector('#cedula_encargado_aux').value;
                                var nombre_madre = Swal.getPopup().querySelector('#encargado_nombre_aux').value;
                                var parentezo = Swal.getPopup().querySelector('#encargado_parentezco').value;
                                var telefono = Swal.getPopup().querySelector('#telefono_encargado_aux').value;

                                axios.post('/encargado_crear',  {
                                    cedula_madre : cedula_madre,
                                    nombre_madre : nombre_madre,
                                    parentezo : parentezo,
                                    telefono : telefono,
                                })
                                .then(respuesta => {
                                    if(respuesta.data.ok == 1){

                                        if(encar == 1){
                                            document.getElementById('id_encargado').value = respuesta.data.id;
                                            document.getElementById('cedula_encargado').value = respuesta.data.cedula;
                                            document.getElementById('nombre_encargado').value = respuesta.data.nombre;
                                        }

                                        if(encar == 2){
                                            document.getElementById('id_encargado1').value = respuesta.data.id;
                                            document.getElementById('cedula_encargado1').value = respuesta.data.cedula;
                                            document.getElementById('nombre_encargado1').value = respuesta.data.nombre;
                                        }

                                        if(encar == 3){
                                            document.getElementById('id_encargado2').value = respuesta.data.id;
                                            document.getElementById('cedula_encargado2').value = respuesta.data.cedula;
                                            document.getElementById('nombre_encargado2').value = respuesta.data.nombre;
                                        }

                                        if(encar == 4){
                                            document.getElementById('id_encargado3').value = respuesta.data.id;
                                            document.getElementById('cedula_encargado3').value = respuesta.data.cedula;
                                            document.getElementById('nombre_encargado3').value = respuesta.data.nombre;
                                        }

                                        Swal.fire(
                                            'Datos del Encargado',
                                            respuesta.data.mensaje,
                                            'success'
                                        )
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: respuesta.data.mensaje,
                                        })
                                    }

                                })
                                .catch(error => {
                                    console.log(error);
                                })
                            }

                    })
                }
            })
        }


    </script>
</x-app-layout>
