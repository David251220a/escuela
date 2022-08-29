<div>

    <div class="mb-4 border-b border-gray-200">

        <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

            <div class="mb-4">
                <label for="">Grado</label>
                <select wire:model.defer="grado_id" name="grado" id="grado" class="w-full rounded border-gray-400 enviar">
                    @foreach ($grado as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="">Turno</label>
                <select wire:model.defer="turno_id" name="turno" id="turno" class="w-full rounded border-gray-400 enviar">
                    @foreach ($turno as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="">Busqueda</label>
                <select wire:model.defer="busqueda_id" class="w-full rounded border-gray-400 enviar">
                    <option value="1">COBRO DE CUOTA</option>
                    <option value="2">COBRO DE MATRICULA</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="">Forma de Cobro</label>
                <select wire:model.defer="tipo_cobro_id" name="tipo_cobro" id="tipo_cobro" class="w-full rounded border-gray-400 enviar">
                    <option value="999">-- TODOS --</option>
                    @foreach ($tipo_cobro as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="">Fecha Desde</label>
                <input wire:model.defer="fecha_desde" type="date" name="desde_fecha" id="desde_fecha" class="border-gray-500 rounded w-full text-right text-base enviar">
            </div>

            <div class="mb-4">
                <label for="">Fecha Hasta</label>
                <input wire:model.defer="fecha_hasta" type="date" name="hasta_fecha" id="hasta_fecha" class="border-gray-500 rounded w-full text-right text-base enviar">
            </div>

            <div class="mb-4">
                <button wire:click="filtrar" class="bg-green-500 rounded px-4 py-2 text-center text-white text-base font-bold mt-5">Filtrar</button>
                @if ($busqueda_id == 1)
                    <a href="{{route('pdf.ingreso_cuota', ['search_cobro'=>$tipo_cobro_id, 'search_grado'=>$grado_id, 'search_turno'=>$turno_id, 'search_desde_fecha' => $fecha_desde, 'search_hasta_fecha'=>$fecha_hasta])}}"
                    class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
                        <i class='bx bxs-file-pdf'></i>
                        PDF
                    </a>
                @else
                    <a href="{{route('pdf.ingreso_matricula', ['search_cobro'=>$tipo_cobro_id, 'search_grado'=>$grado_id, 'search_turno'=>$turno_id, 'search_desde_fecha' => $fecha_desde, 'search_hasta_fecha'=>$fecha_hasta])}}"
                    class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
                        <i class='bx bxs-file-pdf'></i>
                        PDF
                    </a>
                @endif

            </div>

        </div>

    </div>

        @php
            $total = 0;
        @endphp
        <div class="flex flex-col mb-4">
            <div class="-my-2 overflow-y-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-y-auto h-48 border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200 rounded overflow-y-auto h-48 shadow">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cedula</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Alumno</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Cobro</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        {{($busqueda_id == 1 ? 'Cuota' : 'Concepto')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Forma de Pago</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cobrado</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($datos)

                                    @foreach ($datos as $item)

                                        @if ($busqueda_id == 1)
                                            @php
                                                $total = $total + $item->monto_cobrado_cuota;
                                            @endphp
                                            <tr>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                                    {{ number_format($item->matricula_cuota->matricula->alumnos->cedula, 0, ".", ".") }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-left">
                                                    {{ $item->matricula_cuota->matricula->alumnos->apellido }} {{ $item->matricula_cuota->matricula->alumnos->nombre }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">{{ date('d/m/Y', strtotime($item->fecha_cobro)) }}</td>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    {{ $item->matricula_cuota->cuota }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    {{ $item->cobros->forma_pago->nombre }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                                    {{ number_format($item->monto_cobrado_cuota, 0, ".", ".") }}
                                                </td>
                                            </tr>
                                        @else
                                            @php
                                                $total = $total + $item->monto_cobrado_factura;
                                            @endphp
                                            <tr>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                                    {{ number_format($item->matricula->alumnos->cedula, 0, ".", ".") }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-left">
                                                    {{ $item->matricula->alumnos->apellido }} {{ $item->matricula->alumnos->nombre }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    {{ date('d/m/Y', strtotime($item->fecha_cobro)) }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    COBRO MATRICULA
                                                </td>
                                                <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    {{ $item->cobros->forma_pago->nombre }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                                    {{ number_format($item->monto_cobrado_factura, 0, ".", ".") }}
                                                </td>
                                            </tr>
                                        @endif

                                    @endforeach
                                @endif

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="md:grid grid-cols-4 gap-4 px-4 py-6 mb-4">
            <div class="mb-4">
                <label for="">Total de ingreso</label>
                <input type="text" class="border-gray-500 rounded w-full text-right text-base" value="{{ number_format($total, 0, ".", ".") }}" readonly>
            </div>
        </div>

</div>
