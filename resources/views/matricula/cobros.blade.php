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
        <label for="">Estado: <b class="{{($matricula->matricula_estado_id == 2 ? 'text-green-500' : 'text-red-500') }}">{{ $matricula->matricula_estado->nombre }}</b></label>
    </div>

    <div class="mb-4">
        <a href="{{ route('alumno.index') }}"
        class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700">
            <i class='bx bx-arrow-back'></i>
            Volver a Alumnos
        </a>
        <a href="{{ route('pdf.estado_cuenta', $matricula->alumnos->id) }}"
        class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
            <i class='bx bxs-file-pdf'></i>
            Estado Cuenta
        </a>
        {{-- <a href="{{ route('pdf.imprimir_cobro_matricula', $matricula->id) }}"
        class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
            <i class='bx bxs-printer'></i>
            Recibo Matricula
        </a> --}}
    </div>

    <div class="mb-4 border-b border-gray-200">

        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                id="cuota-tab" data-tabs-target="#cuota" type="button" role="tab" aria-controls="cuota" aria-selected="false">
                    <i class="fas fa-comment-dollar mr-1 mt-1"></i>
                    Saldo Cuota
                    </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                    <i class="fas fa-calculator mr-1 mt-1"></i>
                    Pagos
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="estado_cuenta-tab" data-tabs-target="#estado_cuenta" type="button" role="tab" aria-controls="estado_cuenta" aria-selected="false">
                    <i class="fas fa-calculator mr-1 mt-1"></i>
                    Estado Cuenta
                </button>
            </li>
        </ul>
    </div>

    <div id="myTabContent">

        <div class="hidden p-1 rounded-lg" id="cuota" role="tabpanel" aria-labelledby="cuota-tab">

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
                                            <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Aplica Multa</th>
                                            <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Seleccionar</th>
                                        </tr>
                                    </thead>

                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php
                                            $cont = 0;
                                        @endphp

                                        @foreach ($matricula_cuota as $item)

                                            @if ($item->monto_cuota_cobrado < $item->monto_cuota_cobrar)
                                                @php
                                                    $aplica_multa = 0;
                                                    $dias_gracia = $paramentro_general->cantidad_dias_gracia;
                                                    $fecha_limite = date('Y-m-d', strtotime($item->fecha_vencimiento."+ " .$dias_gracia."days"));
                                                    $fecha_vencimiento = date('Y-m-d', strtotime($item->fecha_vencimiento));
                                                    $fecha_actual = date('Y-m-d', strtotime(\Carbon\Carbon::now()));
                                                    if($fecha_limite < $fecha_actual){
                                                        if($item->monto_multa_cobrar == 0){
                                                            $aplica_multa = 1;
                                                        }
                                                    }
                                                @endphp

                                                <tr>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center font-semibold {{ ($aplica_multa == 1 ? 'text-red-600' : '') }}">
                                                        {{ number_format($item->cuota, 0, ".", ".") }}
                                                    </td>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center font-semibold {{ ($aplica_multa == 1 ? 'text-red-600' : '') }}">
                                                        <input type="date" name="fecha_vencimiento[{{$cont}}]" id="fecha_vencimiento[{{$cont}}]"
                                                        value="{{ $item->fecha_vencimiento }}" class=" text-center border-gray-100 font-semibold" readonly>
                                                        <input type="hidden" name="fecha_limite[{{$cont}}]" id="fecha_limite[{{$cont}}]" value="">
                                                    </td>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center font-semibold {{ ($aplica_multa == 1 ? 'text-red-600' : '') }}">
                                                        {{ number_format($item->monto_cuota_cobrar, 0, ".", ".") }}
                                                        <input type="hidden" name="cuota_cobrar[{{$cont}}]" id="cuota_cobrar[{{$cont}}]"
                                                        value="{{$item->monto_cuota_cobrar}}">
                                                    </td>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center font-semibold {{ ($aplica_multa == 1 ? 'text-red-600' : '') }}">
                                                        {{ number_format($item->saldo, 0, ".", ".") }}
                                                        <input type="hidden" name="cuota_saldo[{{$cont}}]" id="cuota_saldo[{{$cont}}]"
                                                        value="{{ number_format($item->saldo, 0, ".", ".") }}"
                                                        class="border border-gray-100 rounded w-full text-center" readonly>
                                                    </td>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center font-semibold {{ ($aplica_multa == 1 ? 'text-red-600' : '') }}">
                                                        {{ number_format($item->monto_cuota_cobrado, 0, ".", ".") }}
                                                        <input type="hidden" name="cuota_cobrado[{{$cont}}]" id="cuota_cobrado[{{$cont}}]"
                                                        value="{{$item->monto_cuota_cobrado}}">
                                                        <input type="hidden" name="aplica_multa[{{$cont}}]" id="aplica_multa[{{$cont}}]"
                                                        value="{{$aplica_multa}}">
                                                    </td>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center font-semibold">
                                                        <input type="checkbox" name="{{$cont}}" id="{{$cont}}" value="{{$aplica_multa}}" {{ ($aplica_multa == 1 ? 'checked' : '') }}
                                                        {{ $aplica_multa == 1 ? '' : 'disabled' }} onclick="recalcular_disminuir_multa(this)">
                                                    </td>
                                                    <td class="px-6 whitespace-nowrap text-sm text-gray-500 text-center font-semibold">
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

                @if ((!empty($matricula->cobro_matricula)))
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
                    </div>
                @endif

                <div class="mt-4">

                    <div class="md:grid grid-cols-4 gap-4 px-4 py-6">
                        <div class="mb-2">
                            <label for="">Aplicar Multa</label>
                            <input type="text" name="multa" id="multa" value="{{ number_format($paramentro_general->monto_multa, 0, ".", ".") }}"
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

            @php
                $saldo = $matricula->monto_matricula;
                $total_matricula_1 = 0;
                $total_cuota_1 = 0;
                $multa = 0;
            @endphp
            <div class="flex flex-col mb-4">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Concepto</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Vencimiento</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-left">Mes</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Cobrado</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Monto a Pagar</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Monto Cobrado</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Monto Saldo</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Multa</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Total Cobrado</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach ($matricula->cobro_matricula as $item)
                                        <tr>
                                            @php
                                                $saldo = $saldo - $item->monto_cobrado_factura;
                                                $total_matricula_1 = $total_matricula_1 + $item->monto_cobrado_factura;
                                            @endphp
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-left">
                                                COBRO MATRICULA
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-center">
                                            </td>
                                            <td></td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-center">
                                                {{ date('d/m/Y', strtotime($item->cobros->fecha_cobro)) }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($matricula->monto_matricula, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($item->monto_cobrado_factura, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($saldo, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right">
                                                0
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($item->monto_cobrado_factura, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-center">
                                                <a href="{{ route('pdf.imprimir_cobro_matricula', ['id'=>$item->id]) }}" target="__blank"><i class='bx bxs-printer'></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="4" class="px-6 py-2 whitespace-nowrap text-gray-500 text-left font-bold text-xl">TOTALES COBRO MATRICULA:</td>
                                        <td colspan="2" class="px-6 py-2 whitespace-nowrap text-gray-500 text-right font-bold text-xl">{{ number_format($total_matricula_1, 0, ".", ".") }}</td>
                                        <td colspan="3" class="px-6 py-2 whitespace-nowrap text-gray-500 text-right font-bold text-xl">{{ number_format($total_matricula_1, 0, ".", ".") }}</td>
                                    </tr>

                                    @foreach ($matricula->cobro_matricula_cuota as $item)
                                        @php
                                            $total_cuota_1 = $total_cuota_1 + $item->monto_cobrado_cuota;
                                        @endphp
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">
                                                COBRO DE CUOTA
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-center">
                                                {{ date('d-m-Y', strtotime($item->matricula_cuota->fecha_vencimiento)) }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-left">
                                                {{Str::upper(\Carbon\Carbon::parse($item->matricula_cuota->fecha_vencimiento)->translatedFormat('F'))}}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-center">
                                                {{ date('d/m/Y', strtotime($item->cobros->fecha_cobro)) }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($item->matricula_cuota->monto_cuota_cobrar, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($item->monto_cobrado_cuota, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($item->monto_saldo_cuota, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($item->monto_multa_a_cobrado, 0, ".", ".") }}
                                                @php
                                                    $multa = $multa + $item->monto_multa_a_cobrado;
                                                @endphp
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($item->monto_multa_a_cobrado + $item->monto_cobrado_cuota, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-center">
                                                <a href="{{ route('imprimir_cobro_cuota', ['id'=>$item->id]) }}" target="__blank"><i class='bx bxs-printer'></i></a>
                                            </td>
                                        </tr>

                                    @endforeach

                                    <tr>
                                        <td colspan="4" class="px-6 py-2 whitespace-nowrap text-gray-500 text-left font-bold text-lg">TOTALES:</td>
                                        <td colspan="2" class="px-6 py-2 whitespace-nowrap text-gray-500 text-right font-bold text-lg">{{ number_format($total_cuota_1, 0, ".", ".") }}</td>
                                        <td colspan="2" class="px-6 py-2 whitespace-nowrap text-gray-500 text-right font-bold text-lg">{{ number_format($multa, 0, ".", ".") }}</td>
                                        <td class="px-6 py-2 whitespace-nowrap text-gray-500 text-right font-bold text-lg">{{ number_format($total_cuota_1 + $multa, 0, ".", ".") }}</td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="hidden p-1 rounded-lg" id="estado_cuenta" role="tabpanel" aria-labelledby="dashboard-tab">

            <div class="flex flex-col mb-4">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Mes</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Vencimiento</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Cobrado</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Monto Cuota</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Monto Cobrado</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Monto Saldo</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Multa</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Total Cobrado</th>
                                    </tr>
                                </thead>
                                @php
                                    $cobrar = 0;
                                    $cobrado = 0;
                                    $multa = 0;
                                    $saldo = 0;
                                @endphp
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach ($matricula_cuota as $item)
                                        @php
                                            $pintar = ($item->saldo > 0 ? 1 : ($item->monto_cuota_cobrado == 0 ? 1 : 0)  );
                                        @endphp
                                        <tr>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-left font-bold {{ ($pintar == 1 ? 'text-red-600' : '') }}">
                                                {{Str::upper(\Carbon\Carbon::parse($item->fecha_vencimiento)->translatedFormat('F'))}}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-center font-bold {{ ($pintar == 1 ? 'text-red-600' : '') }}">
                                                {{ date('d-m-Y', strtotime($item->fecha_vencimiento)) }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-center font-bold {{ ($pintar == 1 ? 'text-red-600' : '') }}">
                                                {{ ( empty($item->cobro_cuota->cobros) ? '' : date('d/m/Y', strtotime($item->cobro_cuota->cobros->fecha_cobro)) )}}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right font-bold {{ ($pintar == 1 ? 'text-red-600' : '') }}">
                                                {{ number_format($item->monto_cuota_cobrar, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right font-bold {{ ($pintar == 1 ? 'text-red-600' : '') }}">
                                                {{ number_format($item->monto_cuota_cobrado, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right font-bold {{ ($pintar == 1 ? 'text-red-600' : '') }}">
                                                {{ number_format($item->monto_cuota_cobrar - $item->monto_cuota_cobrado, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right font-bold {{ ($pintar == 1 ? 'text-red-600' : '') }}">
                                                {{ number_format($item->monto_multa_cobrado, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 text-right font-bold {{ ($pintar == 1 ? 'text-red-600' : '') }}">
                                                {{ number_format($item->monto_multa_cobrado + $item->monto_cuota_cobrado , 0, ".", ".") }}
                                            </td>
                                            @php
                                                $cobrar = $cobrar + $item->monto_cuota_cobrar;
                                                $cobrado = $cobrado + $item->monto_cuota_cobrado;
                                                $multa = $multa + $item->monto_multa_cobrado;
                                                $saldo = ($saldo + ($item->monto_cuota_cobrar - $item->monto_cuota_cobrado));
                                            @endphp
                                        </tr>

                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="px-6 py-2 whitespace-nowrap text-base text-black text-left font-bold">Totales</td>
                                        <td class="px-6 py-2 whitespace-nowrap text-base text-black text-right font-bold">
                                            {{ number_format($cobrar , 0, ".", ".") }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-base text-black text-right font-bold">
                                            {{ number_format($cobrado , 0, ".", ".") }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-base text-black text-right font-bold">
                                            {{ number_format($saldo , 0, ".", ".") }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-base text-black text-right font-bold">
                                            {{ number_format($multa , 0, ".", ".") }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-base text-black text-right font-bold">
                                            {{ number_format($multa + $cobrado , 0, ".", ".") }}
                                        </td>
                                    </tr>
                                </tfoot>


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
