<x-app-layout>

    <h2 class="text-xl text-gray-500 font-semibold mb-2">Editar Ciclo: {{$ciclo->año}}</h2>

    <form action="{{ route('ciclo.update', $ciclo) }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-4 border-b border-gray-200">

            <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

                <div class="mb-4">
                    <label for="">Año</label>
                    <input type="text" name="anio" id="anio"  class="w-full rounded border-gray-400 enviar text-right"
                    value="{{old('anio', $ciclo->año)}}" onkeyup="punto_decimal(this)" onchange="punto_decimal(this)" required>
                </div>

                <div class="mb-4">
                    <label for="">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="w-full rounded border-gray-400 enviar text-right" value="{{old('fecha_inicio', date('Y-m-d', strtotime($ciclo->fecha_inicio)))}}"
                    required>
                </div>

                <div class="mb-4">
                    <label for="">Fecha Fin</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="w-full rounded border-gray-400 enviar text-right" value="{{old('fecha_fin', date('Y-m-d', strtotime($ciclo->fecha_fin)))}}" required>
                </div>

                <div class="mb-4">
                    <label for="">Estado</label>
                    <select name="estado_id" id="estado_id" class="w-full rounded border-gray-400 enviar">
                        <option value="1">ACTIVO</option>
                        <option value="2">INACTIVO</option>
                    </select>
                </div>

            </div>

            <div class="px-4 mb-4">
                <button type="submit"
                class="inline-block px-6 py-2.5 bg-blue-700 text-white font-medium text-xs leading-tight uppercase rounded
                shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-700
                active:shadow-lg transition duration-150 ease-in-out"
                value="" id="btn_procesar">Guardar</button>
            </div>
        </div>
    </form>

    <script>
        function punto_decimal(input){
            var num = input.value.replace(/\./g,'');
            if(!isNaN(num)){
                if(num == ''){

                }else{
                    num = parseInt(num);
                    // num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                    // num = num.split('').reverse().join('').replace(/^[\.]/,'');
                    input.value = num;
                }

            }
            else{
                input.value = input.value.replace(/[^\d\.]*/g,'');
            }
        }
    </script>

</x-app-layout>
