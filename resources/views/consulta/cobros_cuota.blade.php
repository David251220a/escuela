<x-app-layout>

    <div class="mb-4">
        <h2 class="text-2xl text-gray-500 mb-2 text-center font-bold">Consulta Ingresos Cuota</h2>
    </div>

    <div class="flex justify-center border border-gray-300 mb-4">
        <div>
            <h2 class="mb-1 text-2xl text-gray-500 font-bold">Tipo de Consulta</h2>
            <div class="form-check">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600
                checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2
                cursor-pointer" type="radio" name="flexRadioDefault" id="chk_alumno" onclick="ver()" {{($ver == 0 ? 'checked' : '')}}>
                <label class="form-check-label inline-block text-gray-800 text-lg font-semibold" for="chk_alumno">
                    Por Alumno
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600
                checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2
                cursor-pointer" type="radio" name="flexRadioDefault" id="chk_grado" onclick="ver()" {{($ver == 1 ? 'checked' : '')}}>
                <label class="form-check-label inline-block text-gray-800 text-lg font-semibold" for="chk_grado">
                    Por Grado - Turno - Fecha
                </label>
            </div>
        </div>
    </div>

    <div class="mb-4" id="lista_alumno" style="{{($ver == 0 ? 'display: block' : 'display: none' )}}">
        @livewire('consulta-cuota')
    </div>

    <div id="lista_grado" class="mb-4" style="{{($ver == 1 ? 'display: block' : 'display: none' )}}">

        @livewire('consulta-cobroscuota')

        {{-- @if ($busqueda == 1)


            <div class="flex flex-col mb-4">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cedula</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Alumno</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Cobro</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Concepto</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Forma de Pago</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cobrado</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach ($cobro_matricula as $item)
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($item->matricula->alumnos->cedula, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-left">
                                                {{ $item->matricula->alumnos->apellido }} {{ $item->matricula->alumnos->nombre }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                                {{ date('d/m/Y', strtotime($item->fecha_cobro)) }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                                COBRO MATRICULA
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                                {{ $item->cobros->forma_pago->nombre }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($item->monto_cobrado_factura, 0, ".", ".") }}
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
            </div>

            <div class="md:grid grid-cols-4 gap-4 px-4 py-6 mb-4">
                <div class="mb-4">
                    <label for="">Total de ingreso</label>
                    <input type="text" class="border-gray-500 rounded w-full text-right text-base" value="{{ number_format($total_ingreso_aux, 0, ".", ".") }}" readonly>
                </div>
            </div>
        @endif --}}

    </div>

    <script>
        function ver(){
            por_alumno = document.getElementById('chk_alumno').checked;
            por_grado = document.getElementById('chk_alumno').checked;
            lista_alumno = document.getElementById('lista_alumno');
            lista_grado = document.getElementById('lista_grado');
            // checkeado = document.getElementById('checkeado');
            if(por_alumno == true){
                lista_alumno.style = 'display: block';
                lista_grado.style = 'display: none';
                // checkeado.value = 0;
            }else{
                lista_alumno.style = 'display: none';
                lista_grado.style = 'display: block';
                // checkeado.value = 1;
            }
        }

        var element = document.querySelectorAll('.enviar');
        document.addEventListener('keydown', (event) => {
            const keyName = event.key;

            if (event.key == 'Enter') {
                event.preventDefault();
            }
        });
    </script>

</x-app-layout>
