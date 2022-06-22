<x-app-layout>

    <div class="mb-6">
        <a class="text-sm px-4 py-2 mb-4 border rounded  text-white font-bold" style="border-color: blue; background : rgb(7, 101, 189);"
         href="{{ route('alergia.create') }}">Agregar Alergia</a>
    </div>

    {{-- @livewire('alergia-index') --}}
    <div class="mt-4">

        <h2 class="font-bold text-gray-500 text-2xl mb-4">Listado de Alergias</h2>


        {{-- <div class="mt-4 mb-4">
            <input type="text" wire:model="search" class="w-full border-gray-300 rounded">
        </div> --}}


        <div class="flex flex-col mb-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" width="20%" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Id</th>
                                    <th scope="col" width="20%" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-left">Nombre</th>
                                    <th scope="col" width="20%" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Estado</th>
                                    <th scope="col" width="40%" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right"></th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">

                               {{-- EL foreach se utiliza cuando tenes una consulta tipo get --}}
                                @foreach ($alergias as $alergia)
                                    <tr>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-black font-semibold text-center">{{$alergia->id }}</td>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-black font-semibold text-left">{{ $alergia->nombre }}</td>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-black font-semibold text-center">{{ $alergia->estado->nombre }}</td>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-black font-semibold text-right">
                                        <a href="{{ route('alergia.edit',$alergia) }}" class="text-sm px-4 py-2 mb-4 border rounded  text-white font-bold" style="border-color: rgb(255, 136, 0); background : orange;"> Editar</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="">
            {{$alumnos->links()}}
        </div> --}}



    </div>
</x-app-layout>
