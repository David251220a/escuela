<x-app-layout>

    <div class="md:grid grid-cols-2 gap-2 divide-x-full">

        <div class="border border-red-500 mb-4">
            <table class="w-full ">
                <tr>
                    <th>
                        <img
                        src="{{ Storage::url('escudo.jpg')}}"
                        class="rounded w-32"
                        alt="Avatar"
                        />
                    </th>
                    <th>
                        <p class="text-left px-2">
                            Dirección
                            <br>
                            Telef: (021) 999 999  (R.A.)
                            <br>
                            Fax: (021) 999 999
                            <br>
                            Asunción - Paraguay
                        </p>
                    </th>

                    <th width= "40%">
                        <p class="text-right px-2">
                            RECIBO DE DINERO
                            <br>
                            Emitido el: {{  date('d-m-Y', strtotime($cobros->fecha_cobro)) }}
                            <br>
                            N°: {{ number_format($cobros->id, 0, ".", ".") }}
                        </p>
                    </th>
                </tr>
            </table>
            <br>
            <table>
                <tbody class="px-2">
                    <tr>
                        <td class="px-2 text-lg font-semibold">{{ number_format($alumno->cedula, 0, ".", ".") }}</td>
                        <td class="px-2 text-lg font-semibold">{{ $alumno->nombre }} {{ $alumno->apellido }}</td>
                    </tr>
                    <tr style="line-height: 5px">
                        <td class="px-2">Documento</td>
                        <td class="px-2">Alumno</td>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                    <tr style="">
                        <th width="60%" class="text-left text-xl text-gray-500 font-semibold px-2 pt-4">Detalle</th>
                        <th width="40%"></th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($cobros_detalle as $item)
                        <tr>
                            <td class="px-4 py-1">
                                {{$item->ingreso_concepto->nombre}}
                            </td>
                            <td class="text-right py-1">
                                {{number_format($item->monto_cobrado_factura, 0, ".", ".")}}
                                {{ ($item->monto_saldo_factura == 0 ? '' : ' - PAGO PARCIAL' ) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="h-4">
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td  rowspan="2" class="border text-center border-gray-500 mx-auto py-1 text-xl font-bold">
                            {{ number_format($cobros->total_cobrado, 0, ".", ".") }}
                            <p class="text-lg font-semibold">=Total Cobrado</p>
                        </td>
                    </tr>
                    <tr class="h-1">
                        <td></td>
                        <td></td>
                    </tr>

                    @php
                        if($cobros->total_cobrado > 999999){
                            $letra = 'DE GUARANIES';
                        }else{
                            $letra = ' GUARANIES';
                        }
                    @endphp
                    <tr>
                        <td colspan="2" class="w-full px-2 py-1 font-semibold">
                            {{$formatter->toMoney($cobros->total_cobrado, 0, $letra , '');}}
                            <br>
                            <p class="font-light" style="border-top: 1px dashed black;">
                                Total cobrado (en letras)
                            </p>

                        </td>
                    </tr>

                    <tr class="h-4">
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="text-left text-sm">No valido sin la firma y sello del cajero</td>
                        <td class="text-center px-2" style="border-top: 1px solid black;">
                            Firma y Sello
                        </td>
                    </tr>


                </tfoot>
            </table>

        </div>

        <div class="border border-red-500 mb-4">
            <table class="">
                <tr>
                    <th>
                        <img
                        src="{{ Storage::url('escudo.jpg')}}"
                        class="rounded w-32"
                        alt="Avatar"
                        />
                    </th>
                    <th>
                        <p class="text-left px-2">
                            Dirección
                            <br>
                            Telef: (021) 999 999  (R.A.)
                            <br>
                            Fax: (021) 999 999
                            <br>
                            Asunción - Paraguay
                        </p>
                    </th>

                    <th width= "40%">
                        <p class="text-right px-2">
                            RECIBO DE DINERO
                            <br>
                            Emitido el: {{  date('d-m-Y', strtotime($cobros->fecha_cobro)) }}
                            <br>
                            N°: {{ number_format($cobros->id, 0, ".", ".") }}
                        </p>
                    </th>
                </tr>
            </table>
            <br>
            <table>
                <tbody class="px-2">
                    <tr>
                        <td class="px-2 text-lg font-semibold">{{ number_format($alumno->cedula, 0, ".", ".") }}</td>
                        <td class="px-2 text-lg font-semibold">{{ $alumno->nombre }} {{ $alumno->apellido }}</td>
                    </tr>
                    <tr style="line-height: 5px">
                        <td class="px-2">Documento</td>
                        <td class="px-2">Alumno</td>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                    <tr style="">
                        <th width="60%" class="text-left text-xl text-gray-500 font-semibold px-2 pt-4">Detalle</th>
                        <th width="40%"></th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($cobros_detalle as $item)
                        <tr>
                            <td class="px-4 py-1">
                                {{$item->ingreso_concepto->nombre}}
                            </td>
                            <td class="text-right py-1">
                                {{number_format($item->monto_cobrado_factura, 0, ".", ".")}}
                                {{ ($item->monto_saldo_factura == 0 ? '' : ' - PAGO PARCIAL' ) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="h-4">
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td  rowspan="2" class="border text-center border-gray-500 mx-auto py-1 text-xl font-bold">
                            {{ number_format($cobros->total_cobrado, 0, ".", ".") }}
                            <p class="text-lg font-semibold">=Total Cobrado</p>
                        </td>
                    </tr>
                    <tr class="h-1">
                        <td></td>
                        <td></td>
                    </tr>

                    @php
                        if($cobros->total_cobrado > 999999){
                            $letra = 'DE GUARANIES';
                        }else{
                            $letra = ' GUARANIES';
                        }
                    @endphp
                    <tr>
                        <td colspan="2" class="w-full px-2 py-1 font-semibold">
                            {{$formatter->toMoney($cobros->total_cobrado, 0, $letra , '');}}
                            <br>
                            <p class="font-light" style="border-top: 1px dashed black;">
                                Total cobrado (en letras)
                            </p>

                        </td>
                    </tr>

                    <tr class="h-4">
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="text-left text-sm">No valido sin la firma y sello del cajero</td>
                        <td class="text-center px-2" style="border-top: 1px solid black;">
                            Firma y Sello
                        </td>
                    </tr>


                </tfoot>
            </table>

        </div>

    </div>

    <div class="grid grid-cols-3 gap-4 mt-4">
        <div class="flex justify-center mb-4">
            <a href="{{ route('pdf.recibo_varios', [$id, $id2]) }}"
            class="ml-2 border border-blue-500 rounded text-center font-bold px-4 py-2 text-blue-700" target="__blank">
                <i class='bx bxs-file-pdf'></i>
                Imprimir Recibo
            </a>

            <a href="{{ route('ingreso.cobro', $id) }}"
            class="ml-2 border border-blue-500 rounded text-center font-bold px-4 py-2 text-blue-700">
                <i class='bx bx-cart-add'></i>
                Volver a Cobro
            </a>

            <a href="{{ route('alumno.index') }}"
            class="ml-2 border border-blue-500 rounded text-center font-bold px-4 py-2 text-blue-700">
                <i class='bx bx-user-circle'></i>
                Volver a Alumno
            </a>
        </div>

    </div>

</x-app-layout>
