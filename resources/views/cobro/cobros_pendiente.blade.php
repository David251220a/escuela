<x-app-layout>

    <div class="mb-4">
        <h2 class="text-2xl text-gray-500 font-semibold mb-2 text-center">Ingresos Varios - Pendientes</h2>
    </div>

    <div>
        <label for="">Nombre y Apellido:
            <b>{{ number_format($alumno->cedula, 0, ".", ".") }} - {{ $alumno->nombre }} {{ $alumno->apellido }}</b>
        </label>
    </div>
    <div>
        <label for="" class="mr-2">Turno: <b>{{ $alumno->turno->nombre }}</b></label>
        <label for="" class="mr-2">Grado: <b>{{ $alumno->grado->nombre }}</b></label>
        <label for="">Ciclo: <b>{{ $alumno->ciclo->nombre }}</b></label>
    </div>
    <div class="mb-4">
        <label for="">Estado: <b class="text-red-500">PENDIENTE</b></label>
    </div>

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Cobro</th>
                                <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Total a Cobrar</th>
                                <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($cobros as $item)
                                <tr>
                                    <td class="px-6 whitespace-nowrap text-lg text-gray-500 text-center">
                                        {{ date('d-m-Y', strtotime($item->fecha_cobro)) }}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-lg text-gray-500 text-right">
                                        {{ number_format($item->monto_total_factura, 0, ".", ".") }}
                                    </td>
                                    <td>
                                        <a href="{{ route('ingreso.cobros_pendientes_detalle', [$alumno->id, $item->cobro_id]) }}" class="text-red-500 font-semibold text-lg text-right"><i class='bx bx-dollar mr-2'>Ver Detalle</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>
