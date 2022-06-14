<x-app-layout>

    <div class="mb-2">
        <h2 class="text-center text-2xl font-semibold text-gray-600">Cobro de Cuota</h2>
    </div>

    <div>
        <label for="">Nombre y Apellido:
            <b>{{ number_format($matricula->alumnos->cedula, 0, ".", ".") }} - {{ $matricula->alumnos->nombre }} {{ $matricula->alumnos->apellido }}</b>
        </label>
    </div>
    <div>
        <label for="" class="mr-2">Turno: <b>{{ $matricula->turno->nombre }}</b></label>
        <label for="" class="mr-2">Grado: <b>{{ $matricula->grado->nombre }}</b></label>
        <label for="">Ciclo: <b>{{ $matricula->ciclo->nombre }}</b></label>
    </div>
    <div class="mb-4">
        <label for="">Estado: <b class="{{($matricula->estado_id == 1 ? 'text-green-500' : 'text-red-500') }}">{{ $matricula->estado->nombre }}</b></label>
    </div>

    <div class="mb-4">
        <a href="{{ route('alumno.index') }}"
        class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700">
            <i class='bx bx-arrow-back'></i>
            Volver a Alumnos
        </a>

        <a href="{{ route('pdf.imprimir_cobro_matricula', $matricula->id) }}"
        class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
            <i class='bx bxs-printer'></i>
            Recibo Matricula
        </a>
    </div>

    <div class="mb-4 border-b border-gray-200">

        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    <i class="fas fa-comment-dollar mr-1 mt-1"></i>
                    Cuota Saldos
                    </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                    <i class="fas fa-calculator mr-1 mt-1"></i>
                    Historico Cuota
                </button>
            </li>
        </ul>
    </div>

    <div id="myTabContent">

        <div class="hidden p-1 rounded-lg" id="profile" role="tabpanel" aria-labelledby="dashboard-tab">

            <form action="{{ route('matricula.update' , $matricula) }}" method="POST" onsubmit="return checkSubmit();">
                @method('PUT')
                @csrf

                <div class="flex flex-col mb-4">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cuota</th>
                                            <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Vencimiento</th>
                                            <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cuota</th>
                                            <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Saldo</th>
                                            <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cobrado</th>
                                            <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Seleccionar</th>
                                        </tr>
                                    </thead>

                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php
                                            $cont = 0;
                                        @endphp
                                        @foreach ($matricula_cuota as $item)

                                            @if ($item->monto_cuota_cobrado < $item->monto_cuota_cobrar)
                                                <tr>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center">
                                                        {{ number_format($item->cuota, 0, ".", ".") }}
                                                    </td>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center">
                                                        <input type="date" name="fecha_vencimiento[{{$cont}}]" id="fecha_vencimiento[{{$cont}}]"
                                                        value="{{ $item->fecha_vencimiento }}" class=" text-center border-gray-100" readonly>
                                                    </td>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center">
                                                        {{ number_format($item->monto_cuota_cobrar, 0, ".", ".") }}
                                                        <input type="hidden" name="cuota_cobrar[{{$cont}}]" id="cuota_cobrar[{{$cont}}]"
                                                        value="{{$item->monto_cuota_cobrar}}">
                                                    </td>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center">
                                                        <input type="text" name="cuota_saldo[{{$cont}}]" id="cuota_saldo[{{$cont}}]"
                                                        value="{{ number_format($item->saldo, 0, ".", ".") }}"
                                                        class="border border-gray-100 rounded w-full text-center" readonly>
                                                    </td>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center">
                                                        {{ number_format($item->monto_cuota_cobrado, 0, ".", ".") }}
                                                        <input type="hidden" name="cuota_cobrado[{{$cont}}]" id="cuota_cobrado[{{$cont}}]"
                                                        value="{{$item->monto_cuota_cobrado}}">
                                                    </td>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center">
                                                        <input type="checkbox" name="{{$cont}}" id="{{$cont}}" value="0"
                                                        onclick="cal_total_pagar(this)">
                                                        <input type="hidden" name="cuota[]" id="cuota[]" value="{{$item->id}}">
                                                        <input type="hidden" name="cuota_seleccionada[{{$cont}}]" id="cuota_seleccionada[{{$cont}}]"
                                                         value="0">
                                                    </td>
                                                </tr>
                                                @php
                                                    $cont = $cont + 1;
                                                @endphp
                                            @endif

                                        @endforeach

                                    </tbody>

                                </table>
                            </div>

                        </div>

                    </div>

                </div>

                @php
                    $saldo_si = 1;
                    $total_cobrado_matricula = 0;
                @endphp
                @if (!empty($matricula->cobro_matricula))
                    @php
                        foreach($matricula->cobro_matricula as $item){
                            $total_cobrado_matricula = $total_cobrado_matricula + $item->monto_cobrado_factura;
                        }
                        $saldo = $matricula->monto_matricula - $total_cobrado_matricula;
                        if($saldo > 0){
                            $saldo_si = 1;
                        }

                        if ($saldo == 0) {
                            $saldo_si = 0;
                        }
                    @endphp
                @endif

                @if ($saldo_si == 1)
                    <div class="mt-4">

                        <div class="md:grid grid-cols-4 gap-4 px-4 py-6">
                            <div class="mb-2">
                                <label for="">Monto Matricula</label>
                                <input type="text" name="monto_matricula" id="monto_matricula"
                                value="{{  number_format($matricula->monto_matricula - $total_cobrado_matricula, 0, ".", ".") }}"
                                onkeyup="format(this)" onchange="format(this)"
                                class="border-gray-500 rounded w-full text-right">
                            </div>

                            <div class="mb-2">
                                <label for="">Total Matricula a Pagar</label>
                                <input type="text" name="matricula_cobrar" id="matricula_cobrar" value="0"
                                onkeyup="format(this)" onchange="format(this)"
                                class="border-gray-500 rounded w-full text-right">
                            </div>

                    </div>
                @endif

                <div class="mt-4">

                    <div class="md:grid grid-cols-4 gap-4 px-4 py-6">
                        <div class="mb-2" style="display: none">
                            <label for="">Aplicar Multa</label>
                            <input type="text" name="multa" id="multa" value="{{ $paramentro_general->monto_multa }}"
                            onkeyup="format(this)" onchange="format(this)"
                            class="border-gray-500 rounded w-full text-right">
                        </div>

                        <div class="mb-2">
                            <label for="">Total a Cobrar</label>
                            <input type="text" name="total_cobrar" id="total_cobrar" class="border-gray-500 rounded w-full text-right text-2xl" value="0" readonly>
                        </div>

                        <div class="mb-2">
                            <label for="">Total a Pagar</label>
                            <input type="text" name="total_pagar" id="total_pagar" value="0" class="border-gray-500 rounded w-full text-right text-2xl"
                            onkeyup="format(this)" onchange="format(this)" required>
                        </div>

                        <div class="mb-4">
                            <label for="">Tipo de Cobro</label>
                            <select name="tipo_cobro" id="tipo_cobro" class="w-full rounded border-gray-400 enviar">
                                @foreach ($tipo_cobro as $item)
                                    <option {{ (old('tipo_cobro') == $item->id ? 'selected' : '' ) }}  value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>

                <div class="mb-4 pl-4">
                    <button type="submit"
                    class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded
                    shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700
                    active:shadow-lg transition duration-150 ease-in-out"
                     value="">Cobrar</button>
                </div>

            </form>

        </div>

        <div class="hidden p-1 rounded-lg" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <div class="flex flex-col mb-4">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cuota</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Vencimiento</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Cobrado</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cuota</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Saldo</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cobrado</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center"></th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach ($matricula_cuota as $item)

                                        @if ($item->monto_cuota_cobrado > 0)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    {{ number_format($item->cuota, 0, ".", ".") }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    {{ date('d-m-Y', strtotime($item->fecha_vencimiento)) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    {{ date('d-m-Y h:i', strtotime($item->cobro_cuota->cobros->fecha_cobro)) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    {{ number_format($item->monto_cuota_cobrar, 0, ".", ".") }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    {{ number_format($item->saldo, 0, ".", ".") }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    {{ number_format($item->monto_cuota_cobrado, 0, ".", ".") }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    <a href="{{ route('imprimir_cobro_cuota', ['id'=>$item->id]) }}" target="__blank"><i class='bx bxs-printer'></i></a>
                                                </td>
                                            </tr>
                                        @endif

                                    @endforeach

                                </tbody>


                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <input type="hidden" name="dias_gracia" id="dias_gracia" value="{{ $paramentro_general->cantidad_dias_gracia }}">

    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/moment_locale.js') }}"></script>
    <script src="{{ asset('js/cobro_matricula.js') }}"></script>

</x-app-layout>
