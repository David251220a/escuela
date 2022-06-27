<x-app-layout>

    <h2 class="text-xl text-gray-500 font-semibold mb-2">Nuevo Usuario</h2>

    <form action="{{ route('usuario.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="mb-4">
                <label class="block font-semibold text-gray-500 mb-2" for="name">Nombre</label>
                <input type="text" name="name" id="name" class="block border rounded px-4 py-2 w-full focus:outline-none" value="{{ old('name') }}">
            </div>
            <div class="mb-4">
                <label class="block font-semibold text-gray-500 mb-2" for="email">Email</label>
                <input type="email" name="email" id="email" class="block border rounded px-4 py-2 w-full focus:outline-none" value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label class="block font-semibold text-gray-500 mb-2" for="password">Contraseña</label>
                <input type="text" name="password" id="password" class="block border rounded px-4 py-2 w-full focus:outline-none" value="{{ old('password') }}">
            </div>
        </div>
        <button class="bg-blue-500 font-semibold text-white rounded px-4 py-3" type="submit">Guardar</button>
    </form>

</x-app-layout>
