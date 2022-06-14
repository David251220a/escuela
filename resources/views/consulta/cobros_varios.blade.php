<x-app-layout>

    <div class="mb-4">
        <h2 class="text-2xl text-gray-500 font-semibold mb-2 text-center">Ingresos Varios</h2>
    </div>

    <form action="{{ route('consulta.cobros_varios') }}" method="GET">

        <div class="mb-4 border-b border-gray-200">

            <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

                <div class="mb-4">
                    <label for="">Fecha Desde</label>
                    <input type="date" name="desde_fecha" id="desde_fecha" class="border-gray-500 rounded w-full text-right text-base"
                    value="{{date('Y-m-d', strtotime($search_desde_fecha)) }}">
                </div>

                <div class="mb-4">
                    <label for="">Fecha Hasta</label>
                    <input type="date" name="hasta_fecha" id="hasta_fecha" class="border-gray-500 rounded w-full text-right text-base"
                    value="{{date('Y-m-d', strtotime($search_hasta_fecha)) }}">
                </div>

                <div class="mb-4">
                    <label for="">Ingreso Concepto</label>
                    <select name="ingreso_concepto" id="ingreso_concepto" class="w-full rounded border-gray-400 enviar">
                        <option {{ ($search_concepto == 9999 ? 'selected' : '' ) }} value="9999">TODOS</option>
                        @foreach ($ingreso_concepto as $item)
                            <option {{ ($search_concepto == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="">Tipo de Cobro</label>
                    <select name="tipo_cobro" id="tipo_cobro" class="w-full rounded border-gray-400 enviar">
                        <option {{ ($search_cobro == 9999 ? 'selected' : '' ) }} value="999">TODOS</option>
                        @foreach ($tipo_cobro as $item)
                            <option {{ ($search_cobro == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-green-500 rounded px-4 py-2 text-center text-white text-base font-bold mt-5">Filtrar</button>
                    <a href="{{route('pdf.ingreso_varios', ['search_desde_fecha' => $search_desde_fecha, 'search_hasta_fecha' => $search_hasta_fecha ,'search_concepto' => $search_concepto, 'search_cobro' => $search_cobro]) }}"
                    class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
                        <i class='bx bxs-file-pdf'></i>
                        PDF
                    </a>
                </div>

            </div>

        </div>
    </form>

    @php
        $total_ingreso = 0;
        $cantidad = 0;
        foreach ($cobros_aux as $item) {
            $total_ingreso = $total_ingreso + $item->monto_cobrado_factura;
            $cantidad = $cantidad + $item->cantidad;
        }
    @endphp

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cedula</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Alumno</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Ingreso Concepto</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cantidad</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Ingreso</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Estado</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Forma de Cobro</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($cobros as $item)
                                <tr>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">{{ number_format($item->alumno->cedula, 0, ".", ".") }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-left">
                                        {{ $item->alumno->nombre }} {{ $item->alumno->apellido }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">{{ date('d/m/Y', strtotime($item->fecha_cobro)) }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-left">
                                        {{ $item->ingreso_concepto->nombre }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                        {{ $item->cantidad }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">{{ number_format($item->monto_cobrado_factura, 0, ".", ".") }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                        <a
                                        href="#"
                                        class= "text-green-500 font-bold"
                                        >  {{ $item->cobros->estado->nombre }}</a>
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                        {{ $item->cobros->forma_pago->nombre }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        {{$cobros->appends(['desde_fecha' => $search_desde_fecha, 'hasta_fecha' => $search_hasta_fecha, 'tipo_cobro' => $search_cobro, 'ingreso_concepto' => $search_concepto])->links()}}
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

</x-app-layout>
