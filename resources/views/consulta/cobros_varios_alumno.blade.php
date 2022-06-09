<x-app-layout>

    <div class="mb-4">
        <h2 class="text-2xl text-gray-500 font-semibold mb-2 text-center">Consulta Ingresos Varios - Alumno</h2>
    </div>

    <form action="{{ route('consulta.cobros_varios_alumno') }}" method="GET">

        <div class="mb-4 border-b border-gray-200">

            <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

                <div class="mb-4">
                    <label for="">Cedula Alumno</label>
                    <input type="text" name="cedula" id="cedula" class="border-gray-500 rounded w-full text-right text-base enviar"
                    value="{{ number_format($search_cedula, 0, ".", ".") }}" onchange="format(this)" onkeyup="format(this)">
                    <span class="text-red-500 text-sm font-semibold">
                        Press ENTER para validar cedula
                    </span>
                </div>

                <div class="mb-4">
                    <label for="">Nombre Alumno</label>
                    <input type="text" name="nombre" id="nombre" class="border-gray-500 rounded w-full text-right text-base enviar"
                    value="{{ (empty($alumno) ? '' : $alumno->nombre .' '.$alumno->apellido) }}" readonly>
                </div>

                <div class="mb-4">
                    <label for="">Grado</label>
                    <input type="text" name="grado" id="grado" class="border-gray-500 rounded w-full text-right text-base enviar"
                    value="{{ (empty($alumno) ? '' : $alumno->grado->nombre) }}" readonly>
                </div>

                <div class="mb-4">
                    <label for="">Turno</label>
                    <input type="text" name="turno" id="turno" class="border-gray-500 rounded w-full text-right text-base enviar"
                    value="{{ (empty($alumno) ? '' : $alumno->turno->nombre) }}" readonly>
                </div>

                <div class="mb-4">
                    <label for="">Ingreso Concepto</label>
                    <select name="ingreso_concepto" id="ingreso_concepto" class="w-full rounded border-gray-400 enviar">
                        <option {{ ($search_concepto == 9999 ? 'selected' : '' ) }} value="9999">TODOS</option>
                        @foreach ($ingreso_concepto as $item)
                            <option {{ ($search_concepto == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="">Fecha Desde</label>
                    <input type="date" name="desde_fecha" id="desde_fecha" class="border-gray-500 rounded w-full text-right text-base enviar"
                    value="{{date('Y-m-d', strtotime($search_desde_fecha)) }}">
                </div>

                <div class="mb-4">
                    <label for="">Fecha Hasta</label>
                    <input type="date" name="hasta_fecha" id="hasta_fecha" class="border-gray-500 rounded w-full text-right text-base enviar"
                    value="{{date('Y-m-d', strtotime($search_hasta_fecha)) }}">
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-green-500 rounded px-4 py-2 text-center text-white text-base font-bold mt-5">Filtrar</button>
                    <a href="#"
                    class="ml-2 border border-green-500 rounded text-center font-bold px-4 py-2 text-green-700" target="__blank">
                        <i class='bx bxs-file-pdf'></i>
                        PDF
                    </a>
                </div>

            </div>

        </div>
    </form>

    @if (!empty($cobros))
        @php
            $total_ingreso = 0;
            $cantidad = 0;
            foreach ($cobros as $item) {
                $total_ingreso = $total_ingreso + $item->monto_cobrado_factura;
                $cantidad = $cantidad + $item->cantidad;
            }
        @endphp

        <div class="flex flex-col mb-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Ingreso Concepto</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cantidad</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Ingreso</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Estado</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($cobros as $item)
                                    <tr>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">{{ date('Y-m-d', strtotime($item->fecha_cobro)) }}</td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-left">
                                            {{ $item->ingreso_concepto->nombre }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                            {{ $item->cantidad }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">{{ number_format($item->monto_cobrado_factura, 0, ".", ".") }}</td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                                            <a
                                            href="#"
                                            class= "text-green-500 font-bold"
                                            >  {{ $item->cobros->estado->nombre }}</a>
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
            {{$cobros->links()}}
        </div>

        <div class="md:grid grid-cols-4 gap-4 px-4 py-6 mb-4">
            <div class="mb-4">
                <label for="">Total de ingreso</label>
                <input type="text" class="border-gray-500 rounded w-full text-right text-base" value="{{ number_format($total_ingreso, 0, ".", ".") }}" readonly>
            </div>
            <div class="mb-4">
                <label for="">Cantidad</label>
                <input type="text" class="border-gray-500 rounded w-full text-right text-base" value="{{ number_format($cantidad, 0, ".", ".") }}" readonly>
            </div>
        </div>

    @endif

    <script>
        function format(input){
            var num = input.value.replace(/\./g,'');
            if(!isNaN(num)){
                if(num == ''){
                    // input.value = "0";
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

        var element = document.querySelectorAll('.enviar');
        document.addEventListener('keydown', (event) => {
            const keyName = event.key;

            if (event.key == 'Enter') {
                event.preventDefault();
                if(event.target.id == 'cedula'){
                    cedula = document.getElementById('cedula').value;
                    axios.post('/buscar_alumno',  {
                    cedula : cedula
                    })
                    .then(respuesta => {
                        if(JSON.stringify(respuesta.data)=='{}'){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'No se encuentra alumno con este N° de cedula: ' + cedula,
                            })
                        }else{
                            document.getElementById('nombre').value = respuesta.data.nombre+' '+ respuesta.data.apellido;
                        }
                    })
                    .catch(error => {
                        console.log(error);

                    })
                }
            }
        });

    </script>

</x-app-layout>
