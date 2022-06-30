<x-app-layout>

    <div class="mb-2">
        <h2 class="text-center text-2xl font-semibold text-gray-600">Ingresos</h2>
    </div>

    <div>
        <label for="">Nombre y Apellido:
            <b>{{ number_format($alumno->cedula, 0, ".", ".") }} - {{ $alumno->nombre }} {{ $alumno->apellido }}</b>
        </label>
    </div>
    <div>
        <label for="" class="mr-2">Turno: <b>{{ $alumno->turno->nombre }}</b></label>
        <label for="" class="mr-2">Grado: <b>{{ $alumno->grado->nombre }}</b></label>
        <label for="">Ciclo: <b>{{ $alumno->ciclo->nombre }}</b></label>
    </div>

    <div class="mt-6">
        {{-- @livewire('anulacion-show', $alumno) --}}
        @livewire('anulacion-show', ['alumno' => $alumno], key($alumno->id))
    </div>
</x-app-layout>
