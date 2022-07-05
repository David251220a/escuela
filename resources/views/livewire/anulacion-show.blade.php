<div>

    <input type="hidden" wire:model="alumno_id" name="alumno_id" id="alumno_id" value="{{ $alumno_id }}">

    <div class="md:grid grid-cols-4 px-4">
        <div class="mb-4">
            <input wire:model="seleccion" class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border
                border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition
                duration-200 mt-0 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
            <x-jet-label class="">Todo</x-jet-labe>
        </div>
        <div class="mb-4">
            <input wire:model="seleccion" class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border
                border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition
                duration-200 mt-0 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2">
            <x-jet-label class="">Por Numero de Recibo</x-jet-labe>
            <x-jet-input wire:model="search" class="border border-gray-300 py-2 px-2" onkeyup="punto_decimal(this)" onchange="punto_decimal(this)"></x-jet-input>
        </div>

        <div class="mb-4">
            <input wire:model="seleccion" class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border
                border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition
                duration-200 mt-0 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                type="radio" name="inlineRadioOptions" id="inlineRadio1" value="3">
            <x-jet-label class="">Por Fecha Desde-Hasta</x-jet-label>
            @php
                $aux_fecha = date('Y', strtotime(\Carbon\Carbon::now()));
                $menor = $aux_fecha . '-01-01';
                $mayor = $aux_fecha . '-12-31';
            @endphp
            <x-jet-input wire:model="fecha_desde" name="fecha_desde" type="date" min="{{$menor}}" max="{{$mayor}}" class="border border-gray-300 py-2 mb-2"></x-jet-input>
            <x-jet-input wire:model="fecha_hasta" name="fecha_hasta" type="date" min="{{$menor}}" max="{{$mayor}}" class="border border-gray-300 py-2"></x-jet-input>
        </div>
        <div class="mb-4">
            <x-jet-label class="">Tipo de Ingreso</x-jet-labe>
            <select wire:model="consulta" class="w-full text-gray-700 border border-gray-300 rounded">
                <option {{ ($consulta == 0 ? 'selected' : '') }} value="0">Todos</option>
                @foreach ($tipo_consulta as $item)
                    <option {{ ($consulta == $item->id ? 'selected': '') }} value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div>

        <div class="flex flex-col mb-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Nro Cobro</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Cobro</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Tipo Cobro</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Total Cobrado</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right"></th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right"></th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $si = 0;
                                @endphp
                                @foreach ($cobros as $item)
                                    <tr class="{{ ($si == 1 ? 'bg-blue-100' : '') }}">
                                        <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ number_format($item->id, 0, ".", ".") }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ date('d/m/Y', strtotime($item->fecha_cobro)) }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ $item->tipo_cobro->nombre }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-right">{{ number_format($item->total_cobrado, 0, ".", ".") }}</td>
                                        <td width="5%" class="px-6 whitespace-nowrap text-sm text-black font-semibold text-right">
                                            @livewire('anulacion-detalle', ['cobro' => $item], key($item->id))
                                        </td>
                                        <td width="5%" class="px-6 whitespace-nowrap text-sm text-black font-semibold text-right">
                                            {{-- <a href="{{ route('anulacion.show', $item) }}" class="whitespace-nowrap text-2xl mr-2 tip">
                                                <i class='bx bx-notepad' ></i>
                                                <span>Detalles</span>
                                            </a> --}}
                                            @can('anulacion.delete')
                                                <a wire:click="$emit('anular', {{$item->id}})" class="whitespace-nowrap text-2xl mr-2 tip-left">
                                                    <i class='bx bx-block'></i>
                                                    <span>Anular Cobro</span>
                                                </a>
                                            @endcan

                                        </td>

                                    </tr>
                                    @php
                                        if($si == 0){
                                            $si = 1;
                                        }else {
                                            $si = 0;
                                        }
                                    @endphp
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div>
            {{$cobros->links()}}
        </div>
    </div>


    @push('js')

    <script>

        function punto_decimal(input){
            var num = input.value.replace(/\./g,'');
            if(!isNaN(num)){
                if(num == ''){

                }else{
                    num = parseInt(num);
                    num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                    num = num.split('').reverse().join('').replace(/^[\.]/,'');
                    input.value = num;
                }

            }
            else{
                input.value = input.value.replace(/[^\d\.]*/g,'');
            }
        }

        Livewire.on('anular', cobro => {

            Swal.fire({
                title: 'Anular Cobro',
                text: 'Desea anular el cobro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('anulacion-show', 'anular_cobro', cobro);

                    Swal.fire(
                        'Anular Cobro',
                        'Se ha anulado el cobro!.',
                        'success'
                    )
                }
            })
        });

    </script>
    @endpush

</div>
