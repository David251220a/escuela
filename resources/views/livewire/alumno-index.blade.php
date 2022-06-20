<div class="mt-4">

    <h2 class="font-bold text-2xl">Listado de Alumnos</h2>
    <div class="mt-4 mb-4">
        <input type="text" wire:model="search" class="w-full border-gray-300 rounded">
    </div>

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Documento</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Apellido y Nombre</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Grado</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Turno</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($alumnos as $item)
                                <tr>
                                    <td class="px-6 whitespace-nowrap text-xl text-gray-500 text-center">{{ number_format($item->cedula, 0, ".", ".") }}</td>
                                    <td class="px-6 whitespace-nowrap text-xl text-gray-500 text-left">{{ $item->apellido }}, {{ $item->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center">{{ $item->grado->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center">{{ $item->turno->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-right">
                                        <a href="#" class="whitespace-nowrap text-2xl mr-2"><i class='bx bx-user-pin'></i></a>
                                        <a href="{{ route('alumno.edit', $item) }}" class="whitespace-nowrap text-2xl mr-2"><i class='bx bx-edit-alt'></i></a>
                                        <a href="{{ route('matricula.create', [ "id" => $item->id]) }}" class="whitespace-nowrap text-2xl mr-2"><i class='bx bx-user-plus'></i></a>
                                        <a href="{{ route('matricula.cobro', $item->id) }}" class="whitespace-nowrap text-2xl mr-2"><i class='bx bx-coin-stack'></i></a>
                                        <a href="{{ route('ingreso.cobro', $item->id) }}" class="whitespace-nowrap text-2xl mr-2"><i class='bx bx-cart-add'></i></a>
                                        <a href="{{ route('ingreso.cobros_pendientes', $item->id) }}" class="whitespace-nowrap text-2xl mr-2"><i class='bx bxs-bank'></i></a>
                                        <a href="{{ route('consulta.cobros_varios_alumno', [ "cedula" => $item->cedula]) }}" class="whitespace-nowrap text-2xl mr-2"><i class='bx bx-search-alt-2'></i></a>
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
