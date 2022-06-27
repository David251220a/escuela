<x-app-layout>

    <form action="{{ route('rol.update', $rol) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-semibold text-gray-500 mb-2" for="name">Grupo ID</label>
            <input type="text" name="name" id="name" class="block border rounded px-4 py-2 w-full focus:outline-none" value="{{ $rol->name }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold text-gray-500 mb-2 w-full">Permisos</label>
            <div class="grid grid-cols-2 mb-4">
                @foreach ($permisos as $item)
                <label><input type="checkbox" name="permissions[]" id="permissions" value="{{ $item['id'] }}" {{ $rol->hasPermissionTo($item['id']) ? 'checked' : null }}> {{$item->descripcion}}</label>
                @endforeach
            </div>
        </div>
        <button class="bg-blue-500 font-semibold text-white rounded px-4 py-3" type="submit">Guardar</button>
    </form>

</x-app-layout>
