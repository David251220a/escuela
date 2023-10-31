<x-app-layout>

    @section('style')
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    @endsection

    <div class="mb-4 font-bold uppercase text-2xl text-gray-700">

        <div class="header">
            <h1>{{$alumno->nombre}} {{$alumno->apellido}}</h1>
        </div>

    </div>

    <h3 class="font-bold mt-4 mb-2 text-lg text-gray-500">Estado de Cuenta</h3>
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

                            @foreach ($data as $item)
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





</x-app-layout>
