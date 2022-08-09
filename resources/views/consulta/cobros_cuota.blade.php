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

    <div class="" id="lista_alumno" style="{{($ver == 0 ? 'display: block' : 'display: none' )}}">
        @livewire('consulta-cuota')
    </div>

    <div id="lista_grado" style="{{($ver == 1 ? 'display: block' : 'display: none' )}}">

        <form action="{{ route('consulta.cobros_cuota') }}" method="GET">

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
                        <label for="">Busqueda</label>
                        <select name="busqueda" id="busqueda" class="w-full rounded border-gray-400 enviar">
                            <option {{ ($busqueda == 1 ? 'selected' : '' ) }} value="1">COBRO DE CUOTA</option>
                            <option {{ ($busqueda == 2 ? 'selected' : '' ) }} value="2">COBRO DE MATRICULA</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="">Forma de Cobro</label>
                        <select name="tipo_cobro" id="tipo_cobro" class="w-full rounded border-gray-400 enviar">
                            <option {{ ($search_cobro == 999 ? 'selected' : '' ) }} value="999">-- TODOS --</option>
                            @foreach ($tipo_cobro as $item)
                                <option {{ ($search_cobro == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="">Fecha Desde</label>
                        <input type="date" name="desde_fecha" id="desde_fecha" class="border-gray-500 rounded w-full text-right text-base enviar"
                        value="{{date('Y-m-d', strtotime($search_desde_fecha)) }}">
                        <input type="hidden" name="checkeado" id="checkeado" value="{{$ver}}">
                    </div>

                    <div class="mb-4">
                        <label for="">Fecha Hasta</label>
                        <input type="date" name="hasta_fecha" id="hasta_fecha" class="border-gray-500 rounded w-full text-right text-base enviar"
                        value="{{date('Y-m-d', strtotime($search_hasta_fecha)) }}">
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="bg-green-500 rounded px-4 py-2 text-center text-white text-base font-bold mt-5">Filtrar</button>
                        @if ($busqueda == 1)
                            <a href="{{route('pdf.ingreso_cuota', ['search_cobro'=>$search_cobro, 'search_grado'=>$search_grado, 'search_turno'=>$search_turno, 'search_desde_fecha' => $search_desde_fecha, 'search_hasta_fecha'=>$search_hasta_fecha])}}"
                            class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
                                <i class='bx bxs-file-pdf'></i>
                                PDF
                            </a>
                        @else
                            <a href="{{route('pdf.ingreso_matricula', ['search_cobro'=>$search_cobro, 'search_grado'=>$search_grado, 'search_turno'=>$search_turno, 'search_desde_fecha' => $search_desde_fecha, 'search_hasta_fecha'=>$search_hasta_fecha])}}"
                            class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
                                <i class='bx bxs-file-pdf'></i>
                                PDF
                            </a>
                        @endif

                    </div>

                </div>

            </div>

        </form>

        @if ($busqueda == 1)

            @php
                $total_ingreso = 0;
                foreach ($cobros_aux as $item) {

                    $total_ingreso = $total_ingreso + $item->monto_cobrado_cuota;
                }
            @endphp

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
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cuota</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Forma de Pago</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cobrado</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach ($cobros as $item)
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($item->matricula_cuota->matricula->alumnos->cedula, 0, ".", ".") }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-left">
                                                {{ $item->matricula_cuota->matricula->alumnos->apellido }} {{ $item->matricula_cuota->matricula->alumnos->nombre }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">{{ date('d/m/Y', strtotime($item->fecha_cobro)) }}</td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                                {{ $item->matricula_cuota->cuota }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                                {{ $item->cobros->forma_pago->nombre }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                                {{ number_format($item->monto_cobrado_cuota, 0, ".", ".") }}
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
                {{$cobros->appends(['desde_fecha' => $search_desde_fecha, 'hasta_fecha' => $search_hasta_fecha, 'checkeado' => $ver , 'grado'=>$search_grado, 'turno'=>$search_turno])->links()}}
            </div>

            <div class="md:grid grid-cols-4 gap-4 px-4 py-6 mb-4">
                <div class="mb-4">
                    <label for="">Total de ingreso</label>
                    <input type="text" class="border-gray-500 rounded w-full text-right text-base" value="{{ number_format($total_ingreso, 0, ".", ".") }}" readonly>
                </div>
            </div>

        @else
            @php
                $total_ingreso_aux = 0;
                foreach ($cobro_matricula_aux as $aa) {
                    $total_ingreso_aux = $total_ingreso_aux + $aa->monto_cobrado_factura;
                }
            @endphp
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
                {{-- {{$cobro_matricula->appends(['desde_fecha' => $search_desde_fecha, 'hasta_fecha' => $search_hasta_fecha, 'checkeado' => $ver , 'grado'=>$search_grado, 'turno'=>$search_turno])->links()}}
                {{$cobro_matricula->links() }} --}}
            </div>

            <div class="md:grid grid-cols-4 gap-4 px-4 py-6 mb-4">
                <div class="mb-4">
                    <label for="">Total de ingreso</label>
                    <input type="text" class="border-gray-500 rounded w-full text-right text-base" value="{{ number_format($total_ingreso_aux, 0, ".", ".") }}" readonly>
                </div>
            </div>
        @endif

    </div>

    <a href="{{route('dashboard')}}" class="px-4 py-3 bg-red-600 text-white font-bold rounded">Cancelar</a>

    <script>
        function ver(){
            por_alumno = document.getElementById('chk_alumno').checked;
            por_grado = document.getElementById('chk_alumno').checked;
            lista_alumno = document.getElementById('lista_alumno');
            lista_grado = document.getElementById('lista_grado');
            checkeado = document.getElementById('checkeado');
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
