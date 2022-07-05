<x-app-layout>
    <div class="mb-4">
        <h2 class="text-gray-600 font-semibold text-xl">Cambio de Contraseña</h2>
    </div>

    <form action="{{ route('usuario.pass_store') }}" method="post">
        @csrf
        <div class="mb-4">
            <x-jet-label>Contraseña Anterior</x-jet-label>
            <x-jet-input name="anterior" type="password" class="px-2 py-2 border border-gray-300 rounded"></x-jet-input>
        </div>
        <div class="mb-4">
            <x-jet-label>Nuevo Contraseña </x-jet-label>
            <x-jet-input name="nuevo" type="password" class="px-2 py-2 border border-gray-300 rounded"></x-jet-input>
        </div>

        <div class="mb-4 ">
            <button type="submit"
            class="inline-block px-6 py-2.5 bg-blue-700 text-white font-medium text-xs leading-tight uppercase rounded
            shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-700
            active:shadow-lg transition duration-150 ease-in-out"
             value="">Cambiar</button>
        </div>

    </form>

</x-app-layout>
