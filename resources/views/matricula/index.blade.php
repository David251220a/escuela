<x-app-layout>

    {{-- <div class="mb-4">
        <a class="text-sm px-4 py-2 mb-4 border rounded  text-white font-bold" style="border-color: green; background : rgb(7, 189, 7);"
         href="{{  route('matricula.create') }}">Nueva Matriculacion</a>
    </div> --}}

    @livewire('matricula-index')

    <a href="{{route('dashboard')}}"" class="px-4 py-3 bg-red-600 text-white font-bold rounded">Cancelar</a>

</x-app-layout>
