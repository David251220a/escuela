<x-app-layout>

    <h2 class="text-xl text-gray-500 font-semibold mb-2">Editar Usuario: {{ $usuario->name }}</h2>

    <form action="{{ route('usuario.update', $usuario) }}" enctype="multipart/form-usuario" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="mb-4">
                <label class="block font-semibold text-gray-500 mb-2" for="name">Nombre</label>
                <input type="text" name="name" id="name" class="block border rounded px-4 py-2 w-full focus:outline-none" value="{{ $usuario->name }}">
            </div>
            <div class="mb-4">
                <label class="block font-semibold text-gray-500 mb-2" for="email">Email</label>
                <input type="email" name="email" id="email" class="block border rounded px-4 py-2 w-full focus:outline-none" value="{{ $usuario->email }}">
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-500 mb-2" for="email">Rol</label>
                <select name="rol" id="rol" class="block border rounded px-4 py-2 w-full focus:outline-none">
                    <option value=""></option>
                    @foreach ($role as $item)
                        <option value="{{ $item->id }}" {{ $usuario->hasRole($item->id) ? 'selected' : null }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <button class="bg-blue-500 font-semibold text-white rounded px-4 py-3" type="submit">Guardar</button>

    </form>


    <h3 class="font-bold text-2xl mb-6 mt-6">Opciones</h3>
    <div class="mb-10">
        <a class="bg-blue-500 font-semibold text-white rounded px-4 py-3" href="{{ route('resetear_pass', $usuario) }}">Resetear contraseña</a>
    </div>

</x-app-layout>
