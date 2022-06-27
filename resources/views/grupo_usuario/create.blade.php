<x-app-layout>
    <form action="{{ route('rol.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold text-gray-500 mb-2" for="name">Grupo ID</label>
            <input type="text" name="name" id="name" class="block border rounded px-4 py-2 w-full focus:outline-none" value="{{ old('name') }}">
        </div>
        <button class="bg-blue-500 font-semibold text-white rounded px-4 py-3" type="submit">Guardar</button>
    </form>
</x-app-layout>
