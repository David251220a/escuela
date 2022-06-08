<x-app-layout>

    <div class="mb-4">
        <h2 class="text-2xl text-gray-500 font-semibold mb-2 text-center">Ingresos Varios</h2>
    </div>

    <div class="mb-5 border-b border-gray-200">

        <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

            <div class="mb-4">
                <div class="mb-4">
                    <label for="">Cedula Alumno</label>
                    <input type="text" name="cedula" id="cedula" class="w-full rounded border-gray-400 enviar text-right" value="{{ number_format($alumno->cedula, 0, ".", ".") }}"
                    onkeyup="format(this)" onchange="format(this)">
                </div>
            </div>

            <div class="mb-4">
                <label for="">Alumno</label>
                <input type="text" name="alumno" id="alumno" class="w-full rounded border-gray-400 text-right" value="{{$alumno->nombre}} {{$alumno->apellido}}"
                onkeyup="format(this)" onchange="format(this)">
            </div>

            <div class="mb-4">
                <label for="">Grado</label>
                <input type="text" name="grado_id" id="grado_id" class="w-full rounded border-gray-400 text-right" value="{{$alumno->grado->nombre}}">
            </div>

            <div class="mb-4">
                <label for="">Turno</label>
                <input type="text" name="turno_id" id="turno_id" class="w-full rounded border-gray-400 text-right" value="{{$alumno->turno->nombre}}">
            </div>

            <div class="mb-4">
                <label for="">Concepto Ingreso</label>
                <select name="ingreso_concepto" id="ingreso_concepto" class="w-full rounded border-gray-400" onchange="cambiar_precio()" onkeyup="cambiar_precio()">
                    @foreach ($ingreso_concepto as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>

                <select name="ingreso_concepto_precio" id="ingreso_concepto_precio" class="w-full rounded border-gray-400" hidden>
                    @foreach ($ingreso_concepto as $item)
                        <option value="{{ $item->precio }}">{{ $item->precio }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="">Concepto Ingreso</label>
                <input type="text" name="precio" id="precio" class="w-full rounded border-gray-400 enviar text-right" value="{{ number_format($ingreso_concepto[0]->precio, 0, ".", ".") }}"
                onkeyup="format(this)" onchange="format(this)" readonly>
            </div>

            <div class="mb-4">
                <label for="">Cantidad</label>
                <input type="text" name="cantidad" id="cantidad" class="w-full rounded border-gray-400 text-right" value="1"
                onkeyup="format(this)" onchange="format(this)">
            </div>

            <div class="mb-4">
                <button type="button" class="bg-green-500 rounded px-4 py-2 text-center text-white text-base font-bold mt-5" onclick="anadir_ingreso()">Añadir</button>
            </div>

        </div>
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    {{-- <form action="{{ route('cobros.store') }}" method="POST" onsubmit="return checkSubmit();">
                        @csrf --}}

                        <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Concepto Ingreso</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Precio Unitario</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cantidad</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Total Ingreso</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center"></th>
                                </tr>
                            </thead>

                            <tbody id="ingresos">

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="2" class="pl-4 font-bold">CANTIDAD TOTAL:</td>
                                    <td><input type="text" name="cantidad_total" id="cantidad_total" class="w-full text-right border-gray-100" value="0" readonly></td>
                                    <td><input type="text" name="total_ingresoss" id="total_ingresoss" class="w-full text-right border-gray-100" value="0" readonly></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="pl-4 font-bold">TOTAL A PAGAR</td>
                                    <td><input type="text" name="total_pagar" id="total_pagar" class="w-full text-right border-gray-100" value="0" onkeyup="format(this)" onchange="format(this)"></td>
                                </tr>
                            </tfoot>

                        </table>

                    {{-- </form> --}}

                </div>
            </div>
        </div>
    </div>

    <div id="conceptos" style="display: none">

        <div class="md:grid grid-cols-2 gap-4 px-4 py-6">

            <div class="mb-4">
                <label for="">Concepto Ingreso</label>
                <input type="text" name="nombre" id="nombre" class="w-full rounded border-gray-400 enviar text-right"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)" required>
            </div>

            <div class="mb-4">
                <label for="">Precio</label>
                <input type="text" name="precio" id="precio" class="w-full rounded border-gray-400 enviar text-right" value="0"
                onkeyup="format(this)" onchange="format(this)" required>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/crear_ingreso.js') }}"></script>

</x-app-layout>
