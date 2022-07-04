<div>
    <a class="whitespace-nowrap text-2xl mr-2 tip" wire:click="$set('open', true)">
        <i class='bx bx-notepad' ></i>
        <span>Detalles</span>
    </a>
    <x-jet-dialog-modal wire:model="open" maxWidth="2xl">

        <x-slot name="title">
            <x-jet-label class="text-gran-500 text-center text-xl">
                {{$cobro->tipo_cobro->nombre}} -Nro: {{$cobro->id}}
            </x-jet-label>
        </x-slot>

        <x-slot name="content">
            <x-jet-label class="text-gran-500 text-left text-base">
                Detalles
            </x-jet-label>
            <div class="border border-gray-300 w-full px-2 py-2 rounded">

                @if ($cobro->cobro_concepto_id == 1)
                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">
                        <thead>
                            <tr>
                                <th>Monto a Cobrar</th>
                                <th>Monto a Cobrado</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cobro->cobro_matricula as $item)
                                <tr>
                                    <td>
                                        {{number_format($item->monto_total_factura, 0, ".", ".")}}
                                    </td>
                                    <td>
                                        {{number_format($item->monto_cobrado_factura, 0, ".", ".")}}
                                    </td>
                                    <td>
                                        {{number_format($item->monto_saldo_factura, 0, ".", ".")}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                @if ($cobro->cobro_concepto_id == 2)

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">
                        <thead>
                            <tr>
                                <th>Cuota</th>
                                <th>Monto a Cobrar</th>
                                <th>Monto a Cobrado</th>
                                <th>Saldo</th>
                                <th>Multa</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cobro->cobro_matricula_cuota as $item)
                                <tr>
                                    <td>
                                        {{Str::upper(\Carbon\Carbon::parse($item->matricula_cuota->fecha_vencimiento)->translatedFormat('F'))}}
                                    </td>
                                    <td>
                                        {{number_format($item->monto_total_cuota, 0, ".", ".")}}
                                    </td>
                                    <td>
                                        {{number_format($item->monto_cobrado_cuota, 0, ".", ".")}}
                                    </td>
                                    <td>
                                        {{number_format($item->monto_saldo_cuota, 0, ".", ".")}}
                                    </td>
                                    <td>
                                        {{number_format($item->monto_multa_a_cobrar, 0, ".", ".")}}
                                    </td>
                                    <td>
                                        @php
                                            $total = $item->monto_cobrado_cuota + $item->monto_multa_a_cobrar;
                                        @endphp
                                        {{number_format($total, 0, ".", ".")}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @endif

                @if ($cobro->cobro_concepto_id == 3)
                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">
                        <thead>
                            <tr>
                                <th class="px-2 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Concepto</th>
                                <th class="px-2 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">#</th>
                                <th class="px-2 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Mon. a Cobrar</th>
                                <th class="px-2 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Mon. Cobrado</th>
                                <th class="px-2 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cobro->cobro_ingreso as $item)
                                <tr>
                                    <td class="px-2 whitespace-nowrap text-sm text-black font-semibold text-center">
                                        {{$item->ingreso_concepto->nombre}}
                                    </td>
                                    <td class="px-2 whitespace-nowrap text-sm text-black font-semibold text-right">
                                        {{number_format($item->cantidad, 0, ".", ".")}}
                                    </td>
                                    <td class="px-2 whitespace-nowrap text-sm text-black font-semibold text-right">
                                        {{number_format($item->monto_total_factura, 0, ".", ".")}}
                                    </td>
                                    <td class="px-2 whitespace-nowrap text-sm text-black font-semibold text-right">
                                        {{number_format($item->monto_cobrado_factura, 0, ".", ".")}}
                                    </td>
                                    <td class="px-2 whitespace-nowrap text-sm text-black font-semibold text-right">
                                        {{number_format($item->monto_saldo_factura, 0, ".", ".")}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </x-slot>

        <x-slot name="footer">
            {{-- @if ($cobro->cobro_concepto_id == 1) --}}

                <ul>
                    {{-- @foreach ($cobro->cobro_matricula as $item) --}}
                        <li class="text-gray-500 text-lg font-semibold text-left">Total Cobrado: {{number_format($cobro->total_cobrado, 0, ".", ".")}} </li>
                    {{-- @endforeach --}}

                </ul>

            {{-- @endif --}}

        </x-slot>

    </x-jet-dialog-modal>
</div>
