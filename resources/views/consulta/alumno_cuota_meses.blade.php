<x-app-layout>
    <div class="mb-4">
        <h2 class="text-2xl text-gray-500 mb-2 text-center font-bold">Consulta Cuotas Meses Pagados / Alumnos - Grado</h2>
    </div>

    <div class="flex justify-center border border-gray-300 mb-4">
        <div>
            <h2 class="mb-1 text-2xl text-gray-500 font-bold">Tipo de Consulta</h2>
            <div class="form-check">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600
                checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2
                cursor-pointer" type="radio" name="flexRadioDefault" id="chk_alumno" onclick="ver()" {{($ver == 0 ? 'checked' : '')}}>
                <label class="form-check-label inline-block text-gray-800 text-lg font-semibold" for="chk_alumno">
                    Alumno
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600
                checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2
                cursor-pointer" type="radio" name="flexRadioDefault" id="chk_grado" onclick="ver()" {{($ver == 1 ? 'checked' : '')}}>
                <label class="form-check-label inline-block text-gray-800 text-lg font-semibold" for="chk_grado">
                    Grado - Turno
                </label>
            </div>
        </div>
    </div>

    <div class="" id="lista_alumno" style="{{($ver == 0 ? 'display: block' : 'display: none' )}}">
        @livewire('cuotas-pagadas')
    </div>



    <div id="lista_grado" style="{{($ver == 1 ? 'display: block' : 'display: none' )}}">
        <form action="{{ route('consulta.alumno_cuota_meses') }}" method="GET">
            <input type="hidden" name="checkeado" id="checkeado" value="{{$ver}}">
            <div class="mb-4 border-b border-gray-200">

                <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

                    <div class="mb-4">
                        <label for="">Grado</label>
                        <select name="grado" id="grado" class="w-full rounded border-gray-400 enviar">
                            @foreach ($grado as $item)
                                <option {{ ($search_grado == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="">Turno</label>
                        <select name="turno" id="turno" class="w-full rounded border-gray-400 enviar">
                            @foreach ($turno as $item)
                                <option {{ ($search_turno == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="bg-green-500 rounded px-4 py-2 text-center text-white text-base font-bold mt-5">Filtrar</button>
                        <a href="{{ route('pdf.grado_cuota_meses', [$search_grado, $search_turno]) }}"
                        class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
                            <i class='bx bxs-file-pdf'></i>
                            PDF
                        </a>
                    </div>

                </div>

            </div>

        </form>

        <div class="flex flex-col mb-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Nº</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cedula</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Alumno</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Febrero</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Marzo</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Abril</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Mayo</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Junio</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Julio</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Agosto</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Septiembre</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Octubre</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Noviembre</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Total</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $total_general = 0;
                                @endphp
                                @foreach ($alumnos as $item)
                                    <tr>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-bold font-semibold text-right">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-bold font-semibold text-right">
                                            {{ number_format($item->cedula, 0, ".", ".") }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-bold font-semibold text-left">
                                            {{ $item->apellido }} {{ $item->nombre }}
                                        </td>
                                        @php
                                            $tiene_datos = 0;
                                            $posicion = 0;
                                            foreach($matriculas as $matricula){
                                                if($matricula->alumno_id == $item->id){
                                                    $tiene_datos = 1;
                                                    break;
                                                }
                                                $posicion = $posicion + 1;
                                            }
                                        @endphp
                                        @if ($tiene_datos == 0)
                                            <td colspan="10" class="px-6 py-3 text-xs text-bold font-semibold uppercase tracking-wider text-center">No Matriculado</td>
                                        @else
                                            @php
                                                $total = 0;
                                            @endphp

                                            @for ($i = 2; $i <= 11; $i++)
                                                @php
                                                    foreach ($matriculas[$posicion]->cuotas as $cuota) {
                                                        $mes_cuota = date('m', strtotime($cuota->fecha_vencimiento));
                                                        if($i == intval($mes_cuota)){
                                                            $monto_cuota = number_format($cuota->monto_cuota_cobrado, 0, ".", ".");
                                                            $total = $total + $cuota->monto_cuota_cobrado;
                                                            $total_general = $total_general + $cuota->monto_cuota_cobrado;
                                                            break;
                                                        }else {
                                                            $monto_cuota = '-';
                                                        }
                                                    }
                                                @endphp
                                                <td class="px-6 py-3 text-xs text-bold font-semibold uppercase tracking-wider text-right {{ ($monto_cuota > 0 ?: 'text-red-500') }}">{{$monto_cuota}}</td>
                                            @endfor
                                            <td class="px-6 py-3 text-xs text-bold font-semibold uppercase tracking-wider text-right">{{ number_format($total, 0, ".", ".")}}</td>
                                        @endif


                                    </tr>
                                @endforeach

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="12" class="px-6 py-3 text-lg text-bold font-bold uppercase tracking-wider text-left">Total General</td>
                                    <td colspan="2" class="px-6 py-3 text-lg text-bold font-bold uppercase tracking-wider text-right">{{ number_format($total_general, 0, ".", ".")}}</td>
                                </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function ver(){
            por_alumno = document.getElementById('chk_alumno').checked;
            por_grado = document.getElementById('chk_alumno').checked;
            lista_alumno = document.getElementById('lista_alumno');
            lista_grado = document.getElementById('lista_grado');
            if(por_alumno == true){
                lista_alumno.style = 'display: block';
                lista_grado.style = 'display: none';
                checkeado.value = 0;
            }else{
                lista_alumno.style = 'display: none';
                lista_grado.style = 'display: block';
                checkeado.value = 1;
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
