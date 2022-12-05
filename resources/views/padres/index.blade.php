<x-app-layout>

    @if ($titulo == 'Madre')
        @can('madre.create')
            <div class="mb-4">
                <a class="text-sm px-4 py-2 mb-4 border rounded  text-white font-bold" style="border-color: blue; background : rgb(7, 101, 189);"
                onclick="crear_madre()">Agregar {{$titulo}}</a>
            </div>
        @endcan
    @endif

    @if ($titulo == 'Padre')
        @can('madre.create')
            <div class="mb-4">
                <a class="text-sm px-4 py-2 mb-4 border rounded  text-white font-bold" style="border-color: blue; background : rgb(7, 101, 189);"
                onclick="crear_padre()">Agregar {{$titulo}}</a>
            </div>
        @endcan
    @endif

    <div class="mb-4">

        @if ($titulo == 'Madre')
            @livewire('madre-index', ['titulo' => $titulo])
        @endif

        @if ($titulo == 'Padre')
            @livewire('padre-index', ['titulo' => $titulo])
        @endif

        {{-- @livewire('component', ['user' => $user], key($user->id)) --}}
    </div>

    <br>
    <div class="mb-4">
        <a href="{{route('dashboard')}}" class="px-4 py-3 bg-red-600 text-white font-bold rounded">Cancelar</a>
    </div>

    @include('ui.crear_madre')
    @include('ui.crear_padre')
    <script src="{{ asset('js/madre.js') }}"></script>
</x-app-layout>
