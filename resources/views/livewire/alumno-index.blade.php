<div class="mt-4">

    <h2 class="font-bold text-gray-500 text-2xl">Listado de Alumnos</h2>
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
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-left">Apellido y Nombre</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Grado</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Turno</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $si = 0;
                            @endphp
                            @foreach ($alumnos as $item)
                                <tr class="{{ ($si == 1 ? 'bg-blue-100' : '') }}">
                                    <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ number_format($item->cedula, 0, ".", ".") }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-left">{{ $item->apellido }}, {{ $item->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ $item->grado->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ $item->turno->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-right">
                                        @can('alumno.show')
                                            <a href="{{ route('alumno.show', $item) }}" class="whitespace-nowrap text-2xl mr-2 tip">
                                                <i class='bx bx-user-pin'></i>
                                                <span>Ficha</span>
                                            </a>
                                        @endcan

                                        @can('alumno.edit', $post)
                                            <a href="{{ route('alumno.edit', $item) }}" class="whitespace-nowrap text-2xl mr-2 tip">
                                                <i class='bx bx-edit-alt'></i>
                                                <span>Editar</span>
                                            </a>
                                        @endcan

                                        @can('matricula.create')
                                            <a href="{{ route('matricula.create', [ "id" => $item->id]) }}" class="whitespace-nowrap text-2xl mr-2 tip">
                                                <i class='bx bx-user-plus'></i>
                                                <span>Matricula</span>
                                            </a>
                                        @endcan

                                        @can('matricula.cobro')
                                            <a href="{{ route('matricula.cobro', $item->id) }}" class="whitespace-nowrap text-2xl mr-2 tip">
                                                <i class='bx bx-coin-stack'></i>
                                                <span>Cobro Cuota</span>
                                            </a>
                                        @endcan

                                        @can('ingreso.cobro')
                                            <a href="{{ route('ingreso.cobro', $item->id) }}" class="whitespace-nowrap text-2xl mr-2 tip">
                                                <i class='bx bx-cart-add'></i>
                                                <span>Nuevo Ingreso</span>
                                            </a>
                                        @endcan

                                        @can('ingreso.cobros_pendientes')
                                            <a href="{{ route('ingreso.cobros_pendientes', $item->id) }}" class="whitespace-nowrap text-2xl mr-2 tip-left">
                                                <i class='bx bxs-bank'></i>
                                                <span>Ingreso Pendiente</span>
                                            </a>
                                        @endcan

                                        @can('consulta.cobros_varios_alumno')
                                            <a href="{{ route('consulta.cobros_varios_alumno', [ "cedula" => $item->cedula]) }}" class="whitespace-nowrap text-2xl mr-2 tip-left">
                                                <i class='bx bx-search-alt-2'></i>
                                                <span>Consulta Ingreso</span>
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
        {{$alumnos->links()}}
    </div>
</div>
