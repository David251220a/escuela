<x-app-layout>

    <div class="mb-4">
        <a class="text-sm px-4 py-2 mb-4 border rounded  text-white font-bold" style="border-color: blue; background : rgb(7, 101, 189);"
         href="{{ route('alumno.create') }}">Agregar Alumno</a>
    </div>

    <div class="mb-4">
        @livewire('alumno-index')
    </div>

    <br>
    <div class="mb-4">
        <a href="{{route('dashboard')}}" class="px-4 py-3 bg-red-600 text-white font-bold rounded">Cancelar</a>
    </div>


</x-app-layout>
