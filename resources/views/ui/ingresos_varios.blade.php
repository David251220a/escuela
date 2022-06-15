<div class="flex flex-col mb-4">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cedula</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Alumno</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Cobro</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Ingreso Concepto</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Ingreso</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($cobros as $item)
                            <tr>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">{{ number_format($item->alumno->cedula, 0, ".", ".") }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-left">
                                    {{ $item->alumno->apellido }}, {{ $item->alumno->nombre }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">{{ date('Y-m-d', strtotime($item->fecha_cobro)) }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-left">
                                    {{ $item->ingreso_concepto->nombre }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">{{ number_format($item->monto_cobrado_factura, 0, ".", ".") }}</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>

<div class="mb-4">
    {{$cobros->appends(['desde_fecha' => $search_desde_fecha, 'hasta_fecha' => $search_hasta_fecha, 'ingreso_concepto' => $search_concepto , 'grado'=>$search_grado, 'turno'=>$search_turno])->links()}}
</div>

<div class="md:grid grid-cols-4 gap-4 px-4 py-6 mb-4">
    <div class="mb-4">
        <label for="">Total de ingreso</label>
        <input type="text" class="border-gray-500 rounded w-full text-right text-base" value="{{ number_format($total_ingreso, 0, ".", ".") }}" readonly>
    </div>
    <div class="mb-4">
        <label for="">Cantidad</label>
        <input type="text" class="border-gray-500 rounded w-full text-right text-base" value="{{ number_format($cantidad, 0, ".", ".") }}" readonly>
    </div>
</div>
