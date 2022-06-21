<x-app-layout>
    <div class="text-center mb-4">
        <img
          src="{{Storage::url($alumno->foto)}}"
          class="rounded-full w-32 h-32 mb-4 mx-auto"
          alt="Avatar"
        />
        <h5 class="text-xl font-medium leading-tight mb-2">{{$alumno->nombre}} {{ $alumno->apellido}}</h5>
        <p class="text-gray-500">Alumno de <b>{{ $alumno->grado->nombre }}</b> - <b> TURNO {{ $alumno->turno->nombre }}</b></p>

    </div>

    <div class="flex justify-center w-full border border-gray-500 mb-6">
        <div class="block rounded-lg shadow-lg bg-white w-full text-center">
            <div class="py-2 px-6 border-b border-gray-600 text-xl font-semibold">
                Datos del Alumno
            </div>

            <div class="p-2 text-left leading-none">
                <div class="md:grid grid-cols-2 ">

                    <div class="mb-4">
                        <p class="text-gray-700 text-lg">
                            Cedula: <b>{{ number_format($alumno->cedula, 0, ".", ".") }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Nombre y Apellido: <b>{{ $alumno->nombre }}</b> <b>{{ $alumno->apellido }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Fecha Nacimiento: <b>{{ date('d/m/Y', strtotime($alumno->fecha_nacimiento))  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            @php
                                $edad = date_diff(date_create($alumno->fecha_nacimiento), date_create(Carbon\Carbon::now()));
                            @endphp
                            Edad : <b>{{ $edad->y}} años</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Sexo: <b>{{ ($alumno->sexo == 1 ? 'MASCULINO' : 'FEMENINO')  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Lugar de Nacimiento: <b>{{ $alumno->lugar_nacimiento->nombre  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Dirección: <b>{{ $alumno->direccion  }}</b>
                        </p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700 text-lg">
                            Cantidad Hermano: <b>{{ $alumno->cantidad_hermanos }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Linea Baja: <b>{{ $alumno->telefono_baja }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Celular: <b>{{ $alumno->telefono }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Alergia: <b>{{ $alumno->alergia->nombre }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Seguro: <b>{{ $alumno->seguro->nombre }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Enfermedad: <b>{{ $alumno->enfermedad->nombre }}</b>
                        </p>
                    </div>

                </div>
                <div class=" w-full">
                    <p class="text-gray-700 text-lg">Observación: <b>{{ $alumno->observacion_enfermedad }}</b></p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center w-full border border-gray-500">
        <div class="block rounded-lg shadow-lg bg-white w-full text-center">
            <div class="py-2 px-6 border-b border-gray-600 text-xl font-semibold">
                Datos de la Madre
            </div>

            <div class="p-2 text-left leading-none">
                <div class="md:grid grid-cols-2 ">

                    <div class="mb-4">
                        <p class="text-gray-700 text-lg">
                            Cedula: <b>{{ number_format($alumno->cedula, 0, ".", ".") }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Nombre y Apellido: <b>{{ $alumno->nombre }}</b> <b>{{ $alumno->apellido }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Fecha Nacimiento: <b>{{ date('d/m/Y', strtotime($alumno->fecha_nacimiento))  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            @php
                                $edad = date_diff(date_create($alumno->fecha_nacimiento), date_create(Carbon\Carbon::now()));
                            @endphp
                            Edad : <b>{{ $edad->y}} años</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Sexo: <b>{{ ($alumno->sexo == 1 ? 'MASCULINO' : 'FEMENINO')  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Lugar de Nacimiento: <b>{{ $alumno->lugar_nacimiento->nombre  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Dirección: <b>{{ $alumno->direccion  }}</b>
                        </p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700 text-lg">
                            Cantidad Hermano: <b>{{ $alumno->cantidad_hermanos }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Linea Baja: <b>{{ $alumno->telefono_baja }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Celular: <b>{{ $alumno->telefono }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Alergia: <b>{{ $alumno->alergia->nombre }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Seguro: <b>{{ $alumno->seguro->nombre }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Enfermedad: <b>{{ $alumno->enfermedad->nombre }}</b>
                        </p>
                    </div>

                </div>
                <div class=" w-full">
                    <p class="text-gray-700 text-lg">Observación: <b>{{ $alumno->observacion_enfermedad }}</b></p>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
