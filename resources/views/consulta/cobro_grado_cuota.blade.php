<x-app-layout>
    <div class="mb-4">
        <h2 class="text-2xl text-gray-500 font-semibold mb-2 text-center">Ingresos Cuota - Grado / Turno</h2>
    </div>

    <form action="{{ route('consulta.grado_consulta') }}" method="GET">

        <div class="mb-4 border-b border-gray-200">

            <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

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

                <div class="mb-4">
                    <label for="">Ciclo</label>
                    <select name="ciclo" id="ciclo" class="w-full rounded border-gray-400 enviar">
                        @foreach ($ciclo as $item)
                            <option {{ ($anio == $item->año ? 'selected' : '' ) }} value="{{ $item->año }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div></div>

                <div class="mb-4">
                    <label for="">Mes</label>
                    <select name="mes" id="mes" class="w-full rounded border-gray-400 enviar">
                        <option {{ ($search_mes == 2 ? 'selected' : '' ) }} value="2">FEBRERO</option>
                        <option {{ ($search_mes == 3 ? 'selected' : '' ) }} value="3">MARZO</option>
                        <option {{ ($search_mes == 4 ? 'selected' : '' ) }} value="4">ABRIL</option>
                        <option {{ ($search_mes == 5 ? 'selected' : '' ) }} value="5">MAYO</option>
                        <option {{ ($search_mes == 6 ? 'selected' : '' ) }} value="6">JUNIO</option>
                        <option {{ ($search_mes == 7 ? 'selected' : '' ) }} value="7">JULIO</option>
                        <option {{ ($search_mes == 8 ? 'selected' : '' ) }} value="8">AGOSTO</option>
                        <option {{ ($search_mes == 9 ? 'selected' : '' ) }} value="9">SEPTIEMBRE</option>
                        <option {{ ($search_mes == 10 ? 'selected' : '' ) }} value="10">OCTUBRE</option>
                        <option {{ ($search_mes == 11 ? 'selected' : '' ) }} value="11">NOVIEMBRE</option>
                    </select>
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-green-500 rounded px-4 py-2 text-center text-white text-base font-bold mt-5">Filtrar</button>
                    <a href="{{ route('pdf.cuota_mes', ['search_mes'=>$search_mes, 'anio'=>$anio, 'search_turno'=>$search_turno, 'search_grado'=>$search_grado]) }}"
                    class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
                        <i class='bx bxs-file-pdf'></i>
                        PDF
                    </a>
                </div>

            </div>

        </div>
    </form>

    <div class="mt-4 mb-4">
        @php
            $nombre_grado = '';
            $nombre_turno = '';
            foreach($grado as $item){
                if($search_grado == $item->id){
                    $nombre_grado = $item->nombre;
                }
            }

            foreach($turno as $item){
                if($search_turno == $item->id){
                    $nombre_turno = $item->nombre;
                }
            }
        @endphp
        <h2 class="text-lg text-gray-500 font-bold text-center">{{$nombre_grado}} {{ (empty($nombre_turno) ? '' : ' - TURNO '.$nombre_turno) }}</h2>
    </div>

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Documento</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Nombre y Apellido</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Mes Cuota</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Cobro</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto a Cobrar</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cobrado</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Saldo</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200 ">
                            @php
                                $total_cobrar = 0;
                                $total_cobrado = 0;
                                $saldo = 0;
                            @endphp
                            @foreach ($alumno as $item)
                                <tr>
                                    <td class="px-6 whitespace-nowrap text-lg text-gray-500 text-right">{{ number_format($item->cedula, 0, ".", ".") }}</td>
                                    <td class="px-6 whitespace-nowrap text-lg text-gray-500 text-left">{{ $item->nombre }} {{ $item->apellido }}</td>
                                    @foreach ($cobros as $cobro)
                                        @if ($cobro->matricula->alumno_id == $item->id)
                                            @php
                                                $pintar = ($cobro->monto_cuota_cobrado == $cobro->monto_cuota_cobrar ? 0 : 1);
                                                $total_cobrado = $total_cobrado + $cobro->monto_cuota_cobrado;
                                                $total_cobrar = $total_cobrar + $cobro->monto_cuota_cobrar;
                                            @endphp
                                            <td class="px-6 whitespace-nowrap text-lg text-center text-bold font-semibold" style="{{ ($pintar == 1 ? 'background: rgb(211, 84, 84)' : '') }}">
                                                {{Str::upper(\Carbon\Carbon::parse($cobro->fecha_vencimiento)->translatedFormat('F'))}}
                                            </td>
                                            <td class="px-6 whitespace-nowrap text-lg text-center text-bold font-semibold" style="{{ ($pintar == 1 ? 'background: rgb(211, 84, 84)' : '') }}">
                                                {{ (count($cobro->cuota_pagada) == 0 ? '' : date('d/m/Y', strtotime($cobro->cuota_pagada[0]->cobros->fecha_cobro)))  }}

                                            </td>

                                            <td class="px-6 whitespace-nowrap text-lg text-right text-bold font-semibold" style="{{ ($pintar == 1 ? 'background: rgb(211, 84, 84)' : '') }}">
                                                {{ number_format($cobro->monto_cuota_cobrar, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 whitespace-nowrap text-lg text-right text-bold font-semibold" style="{{ ($pintar == 1 ? 'background: rgb(211, 84, 84)' : '') }}">
                                                {{ number_format($cobro->monto_cuota_cobrado, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 whitespace-nowrap text-lg text-right text-bold font-semibold" style="{{ ($pintar == 1 ? 'background: rgb(211, 84, 84)' : '') }}">
                                                {{ number_format($cobro->saldo, 0, ".", ".") }}
                                            </td>

                                            @break

                                        @endif

                                    @endforeach
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot class="">
                            <tr>
                                <td colspan="6" class="text-xl font-semibold">TOTAL A COBRAR</td>
                                <td class="text-xl text-right text-bold font-semibold">{{ number_format($total_cobrar, 0, ".", ".") }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-xl font-semibold">TOTAL A COBRADO</td>
                                <td class="text-xl text-right text-bold font-semibold">{{ number_format($total_cobrado, 0, ".", ".") }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-xl font-semibold">SALDO</td>
                                <td class="text-xl text-right text-bold font-semibold">{{ number_format($total_cobrar - $total_cobrado, 0, ".", ".") }}</td>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            </div>
        </div>
    </div>

    <a href="{{route('dashboard')}}"" class="px-4 py-3 bg-red-600 text-white font-bold rounded">Cancelar</a>

</x-app-layout>
