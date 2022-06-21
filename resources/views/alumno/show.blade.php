<x-app-layout>
    <div class="text-center mb-4">
        <img
          src="{{Storage::url($alumno->foto)}}"
          class="rounded-full w-32 h-32 mb-4 mx-auto"
          alt="Avatar"
        />
        <h5 class="text-xl font-medium leading-tight mb-2">{{$alumno->nombre}} {{ $alumno->apellido}}</h5>
        <p class="text-gray-500">Alumno</p>

    </div>

    <div class="md:grid grid-cols-4 gap-2 px-4">

            <div>

                <div class="w-full border border-gray-300 rounded">
                    <div class="flex justify-center">
                        <div class="block rounded-lg shadow-lg bg-white w-full text-center">
                            <div class="py-2 px-6 border-b border-gray-600 text-xl font-semibold">
                                Datos del Alumno
                            </div>
                            <div class="p-2 text-left leading-none">
                                <p class="text-gray-700 text-lg">
                                    Cedula: <b>{{ number_format($alumno->cedula, 0, ".", ".") }}</b>
                                </p>
                                <p class="text-gray-700 text-lg">
                                    Nombre: <b>{{ $alumno->nombre }}</b>
                                </p>
                                <p class="text-gray-700 text-lg">
                                    Apellido: <b>{{ $alumno->apellido }}</b>
                                </p>
                                <p class="text-gray-700 text-lg">
                                    Fecha Nacimiento: <b>{{ date('d/m/Y', strtotime($alumno->fecha_nacimiento))  }}</b>
                                    Edad : <b>24 años</b>
                                </p>
                                <p class="text-gray-700 text-lg">
                                    Fecha Nacimiento: <b>{{ date('d/m/Y', strtotime($alumno->fecha_nacimiento))  }}</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

    </div>
</x-app-layout>
