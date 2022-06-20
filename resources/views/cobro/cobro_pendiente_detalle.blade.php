<x-app-layout>
    <div class="mb-4">
        <h2 class="text-2xl text-gray-500 font-semibold mb-2 text-center">Ingresos Varios - Pendientes Detalle</h2>
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

    @php
        $total_cobrar = 0;
        $total_saldo = 0;
        $total_cobrado = 0;
        $entro = 'no';

        foreach($cobros as $item){
            $total_cobrar = $total_cobrar + $item->monto_total_factura;
            $total_cobrado = $total_cobrado + $item->monto_cobrado_factura;
        }

        if((!empty($cobros_detalle))){
            foreach ($cobros_detalle as $item) {
                $total_cobrado = $total_cobrado + $item->monto_cobrado_factura;
                $entro = 'si';
            }
        }

        $total_saldo = $total_cobrar - $total_cobrado;
    @endphp

    <div>
        <label for="" class="mr-2 text-xl">TOTAL A COBRAR: <b class="text-red-500">{{ number_format($total_cobrar, 0, ".", ".") }}</b></label>
    </div>
    <div>
        <label for="" class="mr-2 text-xl">TOTAL COBRADO: <b class="text-green-500">{{ number_format($total_cobrado, 0, ".", ".") }}</b></label>
    </div>
    <div>
        <label for="" class="mr-2 text-xl">SALDO: <b class="text-red-500">{{ number_format($total_saldo, 0, ".", ".") }}</b></label>
    </div>

    <form action="{{ route('ingreso.cobros_pendientes_detalle_store', [$id, $id2]) }}" method="post" method="POST" onsubmit="return checkSubmit();">
        @csrf

        <div class="flex flex-col mb-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Concepto</th>
                                    <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cantidad</th>
                                    <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Total a Cobrar</th>
                                    <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Total Cobrado</th>
                                    <th scope="col" class="px-6 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Saldo</th>
                                </tr>
                            </thead>
                            @php
                                $cobrado = 0;
                                $saldo = 0;
                                $total_a_pagar = 0;
                            @endphp
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($cobros as $item)
                                    <tr>
                                        <td class="px-6 whitespace-nowrap text-lg text-gray-500 text-center">
                                            {{ $item->ingreso_concepto->nombre }}
                                            <input type="hidden" name="id_concepto[]" id="id_concepto[]" value="{{ $item->cobro_ingreso_concepto }}">
                                        </td>
                                        <td class="px-6 whitespace-nowrap text-lg text-gray-500 text-center">
                                            {{ $item->cantidad }}
                                            <input type="hidden" name="cantidad[]" id="cantidad[]" value="{{ $item->cantidad }}">
                                        </td>
                                        <td class="px-6 whitespace-nowrap text-lg text-gray-500 text-right">
                                            {{ number_format($item->monto_total_factura, 0, ".", ".") }}
                                            <input type="hidden" name="monto_a_cobrar[]" id="monto_a_cobrar[]" value="{{ $item->monto_total_factura }}">
                                        </td>
                                        @php
                                            if($total_cobrado >= $item->monto_total_factura){
                                                $cobrado = $item->monto_total_factura;
                                                $saldo = 0;
                                            }
                                            if($total_cobrado <= $item->monto_total_factura){
                                                $cobrado = $total_cobrado;
                                                $saldo = $item->monto_total_factura - $total_cobrado;
                                            }
                                            if($total_cobrado <= 0){
                                                $cobrado = 0;
                                                $saldo = $item->monto_total_factura;
                                            }
                                            $total_cobrado = $total_cobrado - $item->monto_total_factura;
                                            $total_a_pagar = $total_a_pagar + $saldo;
                                        @endphp
                                        <td class="px-6 whitespace-nowrap text-lg text-gray-500 text-right">
                                            {{ number_format($cobrado, 0, ".", ".") }}
                                            <input type="hidden" name="monto_cobrado[]" id="monto_cobrado[]" value="{{ $cobrado }}">
                                        </td>
                                        <td class="px-6 whitespace-nowrap text-lg text-gray-500 text-right">
                                            {{ number_format($saldo, 0, ".", ".") }}
                                            <input type="hidden" name="saldo[]" id="saldo[]" value="{{ $saldo }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="px-6 whitespace-nowrap text-lg text-gray-700 text-left font-bold">
                                        TOTAL A COBRAR
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-lg text-gray-700 text-right font-bold">
                                        {{ number_format($total_a_pagar, 0, ".", ".") }}
                                        <input type="hidden" name="total_a_cobrar" value="{{ $total_a_pagar }}" readonly>
                                    </td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>

                </div>

            </div>

        </div>

        <div class="md:grid grid-cols-2 gap-4 px-4 py-6">

            <div class="mb-2">
                <label for="">Total a Pagar</label>
                <input type="text" name="total_pagar_completo" id="total_pagar_completo"
                class="border-gray-500 rounded w-full text-right text-2xl" value="{{ number_format($total_a_pagar, 0, ".", ".") }}"
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

        <div class="mb-4 pl-4">
            <button type="submit"
            class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded
            shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700
            active:shadow-lg transition duration-150 ease-in-out"
            value="">Cobrar</button>
        </div>

    </form>

    <script src="{{ asset('js/cobro_ingreso_parcial.js') }}"></script>
</x-app-layout>
