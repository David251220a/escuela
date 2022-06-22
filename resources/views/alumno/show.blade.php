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

    {{-- MADRE --}}
    <div class="flex justify-center w-full border border-gray-500 mb-6">
        <div class="block rounded-lg shadow-lg bg-white w-full text-center">
            <div class="py-2 px-6 border-b border-gray-600 text-xl font-semibold">
                Datos de la Madre
            </div>

            <div class="p-2 text-left leading-none">
                <div class="md:grid grid-cols-2 ">

                    <div class="mb-4">
                        <p class="text-gray-700 text-lg">
                            Cedula: <b>{{ number_format($alumno->madre->cedula, 0, ".", ".") }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Nombre y Apellido: <b>{{ $alumno->madre->nombre }}</b> <b>{{ $alumno->madre->apellido }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Telefono : <b>{{ $alumno->madre->telefono_wapp }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Telefono Particular: <b>{{ $alumno->madre->telefono_particular }}</b>
                        </p>

                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700 text-lg">
                            Dirección: <b>{{ $alumno->madre->direccion  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Lugar de Trabajo: <b>{{ $alumno->madre->lugar_trabajo }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Dias de Trabajo: <b>{{ $alumno->madre->horario_dias_trabajo }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Telefono Laboral: <b>{{ $alumno->madre->telefono_laboral }}</b>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PADRE --}}
    <div class="flex justify-center w-full border border-gray-500 mb-6">
        <div class="block rounded-lg shadow-lg bg-white w-full text-center">
            <div class="py-2 px-6 border-b border-gray-600 text-xl font-semibold">
                Datos del Padre
            </div>

            <div class="p-2 text-left leading-none">
                <div class="md:grid grid-cols-2 ">

                    <div class="mb-4">
                        <p class="text-gray-700 text-lg">
                            Cedula: <b>{{ number_format($alumno->padre->cedula, 0, ".", ".") }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Nombre y Apellido: <b>{{ $alumno->padre->nombre }}</b> <b> {{ ( $alumno->padre->cedula == 0 ? '' : $alumno->padre->apellido) }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Telefono : <b>{{ $alumno->padre->telefono_wapp }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Telefono Particular: <b>{{ $alumno->padre->telefono_particular }}</b>
                        </p>

                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700 text-lg">
                            Dirección: <b>{{ $alumno->padre->direccion  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Lugar de Trabajo: <b>{{ $alumno->padre->lugar_trabajo }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Dias de Trabajo: <b>{{ $alumno->padre->horario_dias_trabajo }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Telefono Laboral: <b>{{ $alumno->padre->telefono_laboral }}</b>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Encargado --}}
    <div class="flex justify-center w-full border border-gray-500 mb-6">
        <div class="block rounded-lg shadow-lg bg-white w-full text-center">
            <div class="py-2 px-6 border-b border-gray-600 text-xl font-semibold">
                Datos Encargados
            </div>

            <div class="p-2 text-left leading-none">
                <div class="md:grid grid-cols-4 ">

                    <div class="mb-4">
                        <p class="text-center font-semibold text-gray-600 text-xl" style="border-bottom: solid 1px">Encargado 1</p>
                        <p class="text-gray-700 text-lg">
                            Cedula: <b>{{ number_format($alumno->encargado->cedula, 0, ".", ".") }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Nombre y Apellido: <b>{{ $alumno->encargado->nombre }}</b> <b>{{ $alumno->encargado->apellido }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Parentezco: <b>{{ $alumno->encargado->parentezco }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Telefono: <b>{{ $alumno->encargado->telefono  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Observación: <b>{{ $alumno->encargado->observacion  }}</b>
                        </p>
                    </div>

                    <div class="mb-4">
                        <p class="text-center font-semibold text-gray-600 text-xl" style="border-bottom: solid 1px">Encargado 2</p>
                        <p class="text-gray-700 text-lg">
                            Cedula: <b>{{ number_format($alumno->encargado1->cedula, 0, ".", ".") }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Nombre y Apellido: <b>{{ $alumno->encargado1->nombre }}</b> <b>{{ $alumno->encargado1->apellido }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Parentezco: <b>{{ $alumno->encargado1->parentezco }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Telefono: <b>{{ $alumno->encargado1->telefono  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Observación: <b>{{ $alumno->encargado1->observacion  }}</b>
                        </p>
                    </div>

                    <div class="mb-4">
                        <p class="text-center font-semibold text-gray-600 text-xl" style="border-bottom: solid 1px">Encargado 3</p>
                        <p class="text-gray-700 text-lg">
                            Cedula: <b>{{ number_format($alumno->encargado2->cedula, 0, ".", ".") }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Nombre y Apellido: <b>{{ $alumno->encargado2->nombre }}</b> <b>{{ $alumno->encargado2->apellido }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Parentezco: <b>{{ $alumno->encargado2->parentezco }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Telefono: <b>{{ $alumno->encargado2->telefono  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Observación: <b>{{ $alumno->encargado2->observacion  }}</b>
                        </p>
                    </div>

                    <div class="mb-4">
                        <p class="text-center font-semibold text-gray-600 text-xl" style="border-bottom: solid 1px">Encargado 4</p>
                        <p class="text-gray-700 text-lg">
                            Cedula: <b>{{ number_format($alumno->encargado3->cedula, 0, ".", ".") }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Nombre y Apellido: <b>{{ $alumno->encargado3->nombre }}</b> <b>{{ $alumno->encargado3->apellido }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Parentezco: <b>{{ $alumno->encargado3->parentezco }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Telefono: <b>{{ $alumno->encargado3->telefono  }}</b>
                        </p>
                        <p class="text-gray-700 text-lg">
                            Observación: <b>{{ $alumno->encargado3->observacion  }}</b>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Documentos --}}
    <div class="flex justify-center w-full border border-gray-500 mb-6">
        <div class="block rounded-lg shadow-lg bg-white w-full text-center">
            <div class="py-2 px-6 border-b border-gray-600 text-xl font-semibold">
                Datos Encargados
            </div>

            <div class="p-2 text-left leading-none">

                @foreach ($alumno->documentos as $item)
                    <div>
                        <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600
                        checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="checkbox" value="" id="flexCheckDefault" {{ ($item->recibido == 1 ? 'checked' : '') }} @disabled(true)>
                        <label class="form-check-label inline-block text-gray-800 mt-1" for="flexCheckDefault" >
                            {{$item->concepto->nombre}}
                        </label>
                    </div>

                @endforeach

            </div>
        </div>
    </div>

    <h2>GALERIA DE IMAGANES</h2>

    <section class="overflow-hidden text-gray-700 ">
        <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
          <div class="flex flex-wrap -m-1 md:-m-2">
            <div class="flex flex-wrap w-1/3">
              <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                  src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp">
              </div>
            </div>
            <div class="flex flex-wrap w-1/3">
              <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                  src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(74).webp">
              </div>
            </div>
            <div class="flex flex-wrap w-1/3">
              <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                  src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(75).webp">
              </div>
            </div>
            <div class="flex flex-wrap w-1/3">
              <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                  src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(70).webp">
              </div>
            </div>
            <div class="flex flex-wrap w-1/3">
              <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                  src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(76).webp">
              </div>
            </div>
            <div class="flex flex-wrap w-1/3">
              <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                  src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(72).webp">
              </div>
            </div>
          </div>
        </div>
    </section>

</x-app-layout>
