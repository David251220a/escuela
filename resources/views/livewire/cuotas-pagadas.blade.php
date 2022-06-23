<div class="mt-4">

    <h2 class="font-bold text-2xl">Listado de Alumnos</h2>
    <div class="mt-4 mb-4">
        <input type="text" wire:model="search" id="search" class="w-full border-gray-300 rounded">
    </div>

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs text-gray-500 font-semibold uppercase tracking-wider text-right">Documento</th>
                                <th scope="col" class="px-6 py-3 text-xs text-gray-500 font-semibold uppercase tracking-wider text-left">Apellido y Apellido</th>
                                <th scope="col" class="px-6 py-3 text-xs text-gray-500 font-semibold uppercase tracking-wider text-center">Ciclo</th>
                                <th scope="col" class="px-6 py-3 text-xs text-gray-500 font-semibold uppercase tracking-wider text-center">Grado</th>
                                <th scope="col" class="px-6 py-3 text-xs text-gray-500 font-semibold uppercase tracking-wider text-center">Turno</th>
                                <th scope="col" class="px-6 py-3 text-xs text-gray-500 font-semibold uppercase tracking-wider text-right"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($alumnos as $item)
                                <tr>
                                    <td class="px-6 whitespace-nowrap text-sm text--black font-semibold text-right">{{ number_format($item->cedula, 0, ".", ".") }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text--black font-semibold text-left">{{ $item->apellido }}, {{ $item->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text--black font-semibold text-center">
                                        {{$item->ciclo->nombre}}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-sm text--black font-semibold text-center">{{ $item->grado->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text--black font-semibold text-center">{{ $item->turno->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text--black font-semibold text-right">
                                        <a href="{{ route('consulta.ver_alumno_cuota_meses', $item) }}" class="whitespace-nowrap text-lg mr-2"><i class='bx bx-notepad'></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="">
        {{$alumnos->links()}}
    </div>

</div>
