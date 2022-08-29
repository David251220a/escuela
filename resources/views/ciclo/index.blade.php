<x-app-layout>

    <div class="">

        @can('ciclo.create')
            <div class="mb-4">
                <a class="text-sm px-4 py-2 mb-4 border rounded  text-white font-bold" style="border-color: blue; background : rgb(7, 101, 189);"
                href="{{ route('ciclo.create') }}">Agregar</a>
            </div>
        @endcan

        <h2 class="font-bold text-gray-500 text-2xl">Ciclo</h2>


        <div class="flex flex-col mb-4 mt-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Año</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Meses</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Inicio</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Fin</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right"></th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $si = 0;
                                @endphp
                                @foreach ($data as $item)
                                    <tr class="{{ ($si == 1 ? 'bg-blue-100' : '') }}">
                                        <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ number_format($item->año, 0, ".", ".") }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-right">{{ $item->meses }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ date('d/m/Y', strtotime($item->fecha_inicio)) }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ date('d/m/Y', strtotime($item->fecha_fin)) }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-right">
                                            @can('ciclo.edit')
                                                <a href="{{ route('ciclo.edit', $item) }}" class="whitespace-nowrap text-2xl mr-2 tip">
                                                    <i class='bx bx-edit-alt'></i>
                                                    <span>Editar</span>
                                                </a>
                                            @endcan
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

        <div class="">
            {{$data->links()}}
        </div>
    </div>

</x-app-layout>
