<x-app-layout>

    <h2 class="text-xl text-gray-500 font-semibold mb-2">Agregare Alumno</h2>

    <form action="{{ route('alumno.store') }}" method="POST" enctype="multipart/form-data" novalidate onsubmit="return checkSubmit();">

        @csrf

        <div class="mb-4 mt-4 text-center">

            <img
                src="{{ Storage::url('user.png') }}"
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
                            <input type="text" name="cedula" id="cedula"
                            class="w-full rounded border-gray-400 enviar text-right" placeholder="Cedula..." onkeyup="format(this)" onchange="format(this)">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="w-full rounded border-gray-400 enviar" placeholder="Nombre.."
                            onkeyup="mayuscula(this)" onchange="mayuscula(this)">
                        </div>

                        <div class="mb-4">
                            <label for="">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="w-full rounded border-gray-400 enviar" placeholder="Apellido..."
                            onkeyup="mayuscula(this)" onchange="mayuscula(this)">
                        </div>

                        <div class="mb-4">
                            <label for="">Fecha Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="w-full rounded border-gray-400 enviar">
                        </div>

                        <div class="mb-4">
                            <label for="">Sexo</label>
                            <select name="sexo" id="sexo" class="w-full rounded border-gray-400 enviar">
                                <option value="1">MASCULINO</option>
                                <option value="2">FEMENINO</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="">Lugar Nacimiento</label>
                            <select name="lugar_nacimiento" id="lugar_nacimiento" class="w-full rounded border-gray-400 enviar">
                                <p onclick="lugarnacimiento()" class="text-xl font-medium leading-tight mb-2">Lugar Nacimiento</p>
                                <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*" hidden>

                                @foreach ($lugar_nacimiento as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="">Telefono Baja</label>
                            <input type="text" name="telefono_baja" id="telefono_baja" class="w-full rounded border-gray-400 enviar" placeholder="Telefono Baja...">
                        </div>

                        <div class="mb-4">
                            <label for="">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="w-full rounded border-gray-400 enviar" placeholder="Telefono...">
                        </div>

                        <div class="mb-4">
                            <label for="">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="w-full rounded border-gray-400 enviar" placeholder="Dirección..."
                            onkeyup="mayuscula(this)" onchange="mayuscula(this)">
                        </div>

                        <div class="mb-4">
                            <label for="">Alergia</label>
                            <select name="alergia" id="alergia" class="w-full rounded border-gray-400 enviar">
                                @foreach ($alergia as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                            <span>
                                <p class="text-red-500 text-left text-sm font-semibold">Presione F2 para agregar mas opciones</p>
                            </span>
                        </div>

                        <div class="mb-4">
                            <label for="">Seguro</label>
                            <select name="seguro" id="seguro" class="w-full rounded border-gray-400 enviar">
                                @foreach ($seguro as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                            <span>
                                <p class="text-red-500 text-left text-sm font-semibold">Presione F2 para agregar mas opciones</p>
                            </span>
                        </div>

                        <div class="mb-4">
                            <label for="">Cantidad de Hermanos</label>
                            <input type="number" name="cantidad_hermanos" id="cantidad_hermanos" class="w-full rounded border-gray-400 enviar" value="0"  >
                        </div>

                        <div class="mb-4">
                            <label for="">Grado</label>
                            <select name="grado" id="grado" class="w-full rounded border-gray-400 enviar">
                                @foreach ($grado as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="">Turno</label>
                            <select name="turno" id="turno" class="w-full rounded border-gray-400 enviar">
                                @foreach ($turno as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="mb-4 pl-4">
                        <button type="submit"
                        class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded
                        shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700
                        active:shadow-lg transition duration-150 ease-in-out"
                         value="" id="btn_procesar">Guardar</button>
                    </div>
                </div>
            </div>

            <div class="hidden p-1 rounded-lg" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">

                <div class="bg-white rounded overflow-hidden shadow mb-4">

                    <div class="md:grid grid-cols-4 gap-4 px-4 py-6">
                        <div class="mb-4">
                            <label for="">Cedula Madre</label>
                            <input type="text" name="cedula_madre" id="cedula_madre" class="w-full rounded border-gray-400 enviar text-right" value="0"
                            onkeyup="format(this)" onchange="format(this)">
                            <span>
                                <p class="text-red-500 text-left text-sm font-semibold">Presione ENTER para verificar cedula madre</p>
                            </span>
                            <input type="hidden" name="id_madre" id="id_madre" class="w-full rounded border-gray-400 enviar"
                            value="1">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Madre</label>
                            <input type="text" name="nombre_madre" id="nombre_madre" class="w-full rounded border-gray-400 enviar" value="SIN ESPECIFICAR" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="" onclick="ver()">Cedula Padre</label>
                            <input type="text" name="cedula_padre" id="cedula_padre" class="w-full rounded border-gray-400 enviar text-right" value="0"
                            onkeyup="format(this)" onchange="format(this)">
                            <span>
                                <p class="text-red-500 text-left text-sm font-semibold">Presione ENTER para verificar cedula padre</p>
                            </span>
                            <input type="hidden" name="id_padre" id="id_padre" class="w-full rounded border-gray-400 enviar" value="1">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Padre</label>
                            <input type="text" name="nombre_padre" id="nombre_padre" class="w-full rounded border-gray-400 enviar" value="SIN ESPECIFICAR" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="">Cedula Encargado</label>
                            <input type="text" name="cedula_encargado" id="cedula_encargado" class="w-full rounded border-gray-400 enviar text-right" value="0"
                            onkeyup="format(this)" onchange="format(this)">
                            <span>
                                <p class="text-red-500 text-left text-sm font-semibold">Presione ENTER para verificar cedula encargado</p>
                            </span>
                            <input type="hidden" name="id_encargado" id="id_encargado" class="w-full rounded border-gray-400 enviar" value="1">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Encargado</label>
                            <input type="text" name="nombre_encargado" id="nombre_encargado" class="w-full rounded border-gray-400 enviar" value="SIN ESPECIFICAR" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="">Cedula Encargado 1</label>
                            <input type="text" name="cedula_encargado1" id="cedula_encargado1" class="w-full rounded border-gray-400 enviar text-right" value="0"
                            onkeyup="format(this)" onchange="format(this)">
                            <span>
                                <p class="text-red-500 text-left text-sm font-semibold">Presione ENTER para verificar cedula encargado</p>
                            </span>
                            <input type="hidden" name="id_encargado1" id="id_encargado1" class="w-full rounded border-gray-400 enviar" value="1">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Encargado 1</label>
                            <input type="text" name="nombre_encargado1" id="nombre_encargado1" class="w-full rounded border-gray-400 enviar" value="SIN ESPECIFICAR" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="">Cedula Encargado 2</label>
                            <input type="text" name="cedula_encargado2" id="cedula_encargado2" class="w-full rounded border-gray-400 enviar text-right" value="0"
                            onkeyup="format(this)" onchange="format(this)">
                            <span>
                                <p class="text-red-500 text-left text-sm font-semibold">Presione ENTER para verificar cedula encargado</p>
                            </span>
                            <input type="hidden" name="id_encargado2" id="id_encargado2" class="w-full rounded border-gray-400 enviar" value="1">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Encargado 2</label>
                            <input type="text" name="nombre_encargado2" id="nombre_encargado2" class="w-full rounded border-gray-400 enviar" value="SIN ESPECIFICAR" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="">Cedula Encargado 3</label>
                            <input type="text" name="cedula_encargado3" id="cedula_encargado3" class="w-full rounded border-gray-400 enviar text-right" value="0"
                            onkeyup="format(this)" onchange="format(this)">
                            <span>
                                <p class="text-red-500 text-left text-sm font-semibold">Presione ENTER para verificar cedula encargado</p>
                            </span>
                            <input type="hidden" name="id_encargado3" id="id_encargado3" class="w-full rounded border-gray-400 enviar" value="1">
                        </div>

                        <div class="mb-4">
                            <label for="">Nombre Encargado 3</label>
                            <input type="text" name="nombre_encargado3" id="nombre_encargado3" class="w-full rounded border-gray-400 enviar" value="SIN ESPECIFICAR" readonly>
                        </div>

                    </div>

                </div>

            </div>

            <div class="hidden p-1 rounded-lg" id="documento_alumno" role="tabpanel" aria-labelledby="documento_alumno-tab">

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
                    <input type="text" name="cedula_madre_aux" id="cedula_madre_aux" class="w-full rounded border-gray-400 enviar text-right"
                    onkeyup="format(this)" onchange="format(this)">
                </div>

                <div class="mb-4">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre_madre_aux" id="nombre_madre_aux" class="w-full rounded border-gray-400 enviar"
                    onkeyup="mayuscula(this)" onchange="mayuscula(this)">
                </div>

                <div class="mb-4">
                    <label for="">Apellido</label>
                    <input type="text" name="apellido_madre_aux" id="apellido_madre_aux" class="w-full rounded border-gray-400 enviar"
                    onkeyup="mayuscula(this)" onchange="mayuscula(this)">
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
                    <input type="text" name="direccion_madre_aux" id="direccion_madre_aux" class="w-full rounded border-gray-400 enviar"
                    onkeyup="mayuscula(this)" onchange="mayuscula(this)">
                </div>

                <div class="mb-4">
                    <label for="">Lugar de Trabajo</label>
                    <input type="text" name="trabajo_madre_aux" id="trabajo_madre_aux" class="w-full rounded border-gray-400 enviar"
                    onkeyup="mayuscula(this)" onchange="mayuscula(this)">
                </div>

                <div class="mb-4">
                    <label for="">Dias de Trabajo</label>
                    <input type="text" name="dias_trabajo_madre_aux" id="dias_trabajo_madre_aux" class="w-full rounded border-gray-400 enviar"
                    onkeyup="mayuscula(this)" onchange="mayuscula(this)">
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
                    <input type="text" name="cedula_padre_aux" id="cedula_padre_aux" class="w-full rounded border-gray-400 enviar text-right"
                    onkeyup="format(this)" onchange="format(this)">
                </div>

                <div class="mb-4">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre_padre_aux" id="nombre_padre_aux" class="w-full rounded border-gray-400 enviar"
                    onkeyup="mayuscula(this)" onchange="mayuscula(this)">
                </div>

                <div class="mb-4">
                    <label for="">Apellido</label>
                    <input type="text" name="apellido_padre_aux" id="apellido_padre_aux" class="w-full rounded border-gray-400 enviar"
                    onkeyup="mayuscula(this)" onchange="mayuscula(this)">
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
                    <input type="text" name="direccion_padre_aux" id="direccion_padre_aux" class="w-full rounded border-gray-400 enviar"
                    onkeyup="mayuscula(this)" onchange="mayuscula(this)">
                </div>

                <div class="mb-4">
                    <label for="">Lugar de Trabajo</label>
                    <input type="text" name="trabajo_padre_aux" id="trabajo_padre_aux" class="w-full rounded border-gray-400 enviar"
                    onkeyup="mayuscula(this)" onchange="mayuscula(this)">
                </div>

                <div class="mb-4">
                    <label for="">Dias de Trabajo</label>
                    <input type="text" name="dias_trabajo_padre_aux" id="dias_trabajo_padre_aux" class="w-full rounded border-gray-400 enviar"
                    onkeyup="mayuscula(this)" onchange="mayuscula(this)">
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
                    <input type="text" name="encargado_nombre_aux" id="encargado_nombre_aux" class="w-full rounded border-gray-400 enviar"
                    onkeyup="mayuscula(this)" onchange="mayuscula(this)">
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
                <input type="text" name="nombre_tipo_aux" id="nombre_tipo_aux" class="w-full rounded border-gray-400 enviar"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

        </div>
    </div>

    <script src="{{ asset('js/crear_alumno.js') }}"></script>
</x-app-layout>
