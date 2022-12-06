<x-app-layout>
    @can('madre.create')
        <div class="mb-4">
            <a class="text-sm px-4 py-2 mb-4 border rounded  text-white font-bold" style="border-color: blue; background : rgb(7, 101, 189);"
            onclick="crear_encargado()">Agregar Encargado</a>
        </div>
    @endcan

    <div class="mb-4">

        @livewire('encargado-index')

    </div>

    <br>
    <div class="mb-4">
        <a href="{{route('dashboard')}}" class="px-4 py-3 bg-red-600 text-white font-bold rounded">Cancelar</a>
    </div>
    @include('ui.crear_encargado')
    <script src="{{ asset('js/madre.js') }}"></script>
</x-app-layout>
