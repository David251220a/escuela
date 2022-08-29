<x-app-layout>

    <h2 class="font-bold text-gray-500 text-2xl">Parametro General</h2>

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <form action="{{ route('parametro_general.store') }} " method="POST">
                        @csrf
                        <div class="md:grid grid-cols-4 gap-2 px-4">

                            <div class="mb-2 mt-2">
                                <label for="">Monto Multa</label>
                                <input type="text" name="monto_multa" id="monto_multa" class="w-full rounded border-gray-400 enviar text-right" value="{{number_format($data->monto_multa, 0, ".", ".")}}"
                                onkeyup="punto_decimal(this)" onchange="punto_decimal(this)" required>
                            </div>

                            <div class="mb-2 mt-2">
                                <label for="">Días de Gracia</label>
                                <input type="text" name="dias_gracia" id="dias_gracia" class="w-full rounded border-gray-400 enviar text-right" value="{{number_format($data->cantidad_dias_gracia, 0, ".", ".")}}"
                                onkeyup="punto_decimal(this)" onchange="punto_decimal(this)" required>
                            </div>

                        </div>

                        <div class="px-4 mb-4 mt-4">
                            <button type="submit"
                            class="inline-block px-6 py-2.5 bg-blue-700 text-white font-medium text-xs leading-tight uppercase rounded
                            shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-700
                            active:shadow-lg transition duration-150 ease-in-out"
                            value="" id="btn_procesar">Actualizar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
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
</x-app-layout>
