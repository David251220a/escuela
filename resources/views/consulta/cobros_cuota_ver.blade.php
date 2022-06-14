<x-app-layout>
    <h2 class="font-bold text-2xl mb-3">Cobros de Cuotas</h2>

    <div>
        <label for="">Nombre y Apellido:
            <b>{{ number_format($alumno->cedula, 0, ".", ".") }} - {{ $alumno->nombre }} {{ $alumno->apellido }}</b>
        </label>
    </div>
    <div>
        <label for="" class="mr-2">Turno: <b>{{ $alumno->turno->nombre }}</b></label>
        <label for="" class="mr-2">Grado: <b>{{ $alumno->grado->nombre }}</b></label>
        <label for="">Ciclo: <b>{{ $alumno->matricula[0]->ciclo->nombre }}</b></label>
    </div>
    <div class="mb-4">
        <label for="">Estado: <b class="{{($alumno->matricula[0]->estado_id == 1 ? 'text-green-500' : 'text-red-500') }}">{{ $alumno->matricula[0]->estado->nombre }}</b></label>
    </div>

    <div class="mb-4">

        <a href="{{ route('pdf.estado_cuenta', $alumno->id) }}"
        class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
            <i class='bx bxs-file-pdf'></i>
            Estado Cuenta
        </a>

        <a href="{{ route('consulta.cobros_cuota') }}"
        class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700">
            <i class='bx bx-arrow-back'></i>
            Volver Atras
        </a>

    </div>
    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cuota</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Vencimiento</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Total a Cobrar</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Total Cobrado</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Saldo</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Tipo Cobro</th>
                            </tr>
                        </thead>
                        @php
                            $total_saldo = 0;
                            $total_cobrar = 0;
                            $total_cobrado = 0;
                        @endphp

                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($alumno->matricula[0]->cobro_matricula_cuota as $item)
                                <tr>
                                    <td class="px-6 whitespace-nowrap text-xl text-gray-500 text-center">
                                        {{ number_format($item->matricula_cuota->cuota, 0, ".", ".") }}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-xl text-gray-500 text-center">
                                        {{ date('d-m-Y', strtotime($item->matricula_cuota->fecha_vencimiento)) }}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-xl text-gray-500 text-center">
                                        {{ number_format($item->monto_total_cuota, 0, ".", ".") }}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-xl text-gray-500 text-center">
                                        {{ number_format($item->monto_cobrado_cuota, 0, ".", ".") }}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-xl text-gray-500 text-center">
                                        {{ number_format($item->monto_saldo_cuota, 0, ".", ".") }}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-xl text-gray-500 text-center">
                                        {{ $item->cobros->forma_pago->nombre }}
                                    </td>
                                    @php
                                        $total_saldo =  $total_saldo + $item->monto_saldo_cuota;
                                        $total_cobrar = $total_cobrar + $item->monto_total_cuota;
                                        $total_cobrado = $total_cobrado + $item->monto_cobrado_cuota;
                                    @endphp
                                </tr>
                            @endforeach

                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="5" class="px-6 whitespace-nowrap text-xl text-gray-500 text-left">TOTAL COBRADO</td>
                                <td class="px-6 whitespace-nowrap text-xl text-gray-500 text-right">{{ number_format($total_cobrado, 0, ".", ".") }}</td>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
