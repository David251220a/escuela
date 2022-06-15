<x-app-layout>
    <div class="mb-4">
        <h2 class="text-2xl text-gray-500 font-semibold mb-2 text-center">Ingresos Varios - Grado / Turno</h2>
    </div>


    <form action="{{ route('consulta.cobros_varios_grado') }}" method="GET">

        <div class="mb-4 border-b border-gray-200">

            <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

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
                    <label for="">Grado</label>
                    <select name="grado" id="grado" class="w-full rounded border-gray-400 enviar">
                        @foreach ($grado as $item)
                            <option {{ ($search_grado == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="">Turno</label>
                    <select name="turno" id="turno" class="w-full rounded border-gray-400 enviar">
                        @foreach ($turno as $item)
                            <option {{ ($search_turno == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div></div>

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
                    <button type="submit" class="bg-green-500 rounded px-4 py-2 text-center text-white text-base font-bold mt-5">Filtrar</button>
                    <a href="{{ route('pdf.ingreso_grado_turno', ['grado' => $search_grado, 'turno' => $search_turno, 'ingreso' => $search_concepto, 'fecha_desde' => $search_desde_fecha, 'fecha_hasta' => $search_hasta_fecha])}}"
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

    @if ($unico == 0)
        @include('ui.ingresos_varios')
    @else
        @include('ui.ingresos_unico')
    @endif


</x-app-layout>
