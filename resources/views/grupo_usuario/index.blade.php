<x-app-layout>

    <div class="mb-6">
        <a class="text-sm px-4 py-2 mb-4 border border-blue-500 rounded text-blue-500 font-bold" href="{{  route('rol.create') }}">Nuevo Grupo</a>
    </div>

    <h2 class="font-bold text-gray-500 text-2xl mb-4">Listado de Grupo de Usuario</h2>

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Grupo</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $si = 0;
                            @endphp
                            @foreach ($data as $item)
                                <tr class="{{ ($si == 1 ? 'bg-blue-100' : '') }}">
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-black font-semibold text-left">{{ Str::upper($item->name) }}</td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-black font-semibold text-right">
                                        <a href="{{ route('rol.edit', $item) }}" class="whitespace-nowrap text-2xl mr-2 tip">
                                            <i class='bx bx-edit-alt'></i>
                                            <span>Editar</span>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    if($si == 0){
                                        $si = 1;
                                    }else {
                                        $si = 0;
                                    }
                                @endphp
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
