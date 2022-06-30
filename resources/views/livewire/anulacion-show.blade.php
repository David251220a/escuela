<div>

    <input type="hidden" wirwire:model="alumno_id" name="alumno_id" id="alumno_id" value="{{ $alumno_id }}">

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
            <x-jet-label class="">Por Fecha Desde-Hasta</x-jet-labe>
            <x-jet-input wire:model="fecha_desde" name="fecha_desde" type="date" class="border border-gray-300 py-2 mb-2"></x-jet-input>
            <x-jet-input wire:model="fecha_hasta" name="fecha_hasta" type="date" class="border border-gray-300 py-2"></x-jet-input>
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
        {{$search}} {{$fecha_hasta}}
        @foreach ($cobros as $item)
            <div>
                {{$item->total_cobrado}}
            </div>

        @endforeach
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

    </script>
    @endpush

</div>
