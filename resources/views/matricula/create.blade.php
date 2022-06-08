<x-app-layout>

    <h2 class="text-xl text-gray-500 font-semibold mb-2">Nueva Matricula</h2>

    <form action=" {{ route('matricula.store') }} " method="POST" onsubmit="return checkSubmit();">

        @csrf

        <div class="mb-4 border-b border-gray-200">

            <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

                <div class="mb-4">
                    <label for="">Cedula Alumno</label>
                    <input type="text" name="cedula" id="cedula"  class="w-full rounded border-gray-400 enviar text-right"
                    value="{{ old('cedula') }}" onkeyup="format(this)" onchange="format(this)" placeholder="Cedula..."  >
                    <span>
                        <p class="text-red-500 text-left text-sm font-semibold">Presione enter para validar numero de cedula</p>
                    </span>
                </div>

                <div class="mb-4">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre_apellido" id="nombre_apellido" class="w-full rounded border-gray-400 enviar enviar"
                    value="{{ old('nombre_apellido', "SIN ESPECIFICAR") }}" readonly>
                </div>

                <div class="mb-4">
                    <label for="">Grado</label>
                    <select name="grado" id="grado" class="w-full rounded border-gray-400 enviar">
                        @foreach ($grado as $item)
                            <option {{ (old('grado') == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="">Turno</label>
                    <select name="turno" id="turno" class="w-full rounded border-gray-400 enviar">
                        @foreach ($turno as $item)
                            <option {{ (old('turno') == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="">Ciclo</label>
                    <select name="ciclo" id="ciclo" class="w-full rounded border-gray-400 enviar">
                        @foreach ($ciclo as $item)
                            <option {{ (old('ciclo') == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="">Monto Matricula</label>
                    <input type="text" name="matricula" id="matricula" class="w-full rounded border-gray-400 enviar text-right"
                    onkeyup="format(this)" onchange="format(this)" value="{{ old('matricula', 0) }}" required>
                </div>

                <div class="mb-4">
                    <label for="">Monto Cuota</label>
                    <input type="text" name="monto_cuota" id="monto_cuota" class="w-full rounded border-gray-400 enviar text-right"
                    value="{{ old('monto_cuota', 0) }}" onkeyup="format(this)" onchange="format(this)">
                </div>

                <div class="mb-4">
                    <label for="">Fecha Inicio (Cuota)</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="w-full rounded border-gray-400 enviar" value="{{ old('fecha_inicio') }}">
                </div>

                <div class="mb-4">
                    <label for="">Cantidad_Cuota</label>
                    <input type="number" name="cantidad_cuota" id="cantidad_cuota" class="w-full rounded border-gray-400 enviar text-right"
                    value="{{ old('cantidad_cuota', 0) }}">
                </div>

                <div class="mb-4 mt-6">
                    <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm
                    bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition
                    duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                    type="checkbox" value="0" id="paga_matricula" name="paga_matricula" onclick="check_paga_matricula()">
                    <label class="form-check-label inline-block text-gray-800 font-bold" for="flexCheckDefault">
                        Pagar Matricula
                    </label>

                </div>

                <div class="mb-4" id="h_matricula_cobrar" style="display: none">
                    <label for="">Matricula a Cobrar</label>
                    <input type="text" name="matricula_cobrar" id="matricula_cobrar" class="w-full rounded border-gray-400 enviar text-right"
                    value="{{ old('matricula_cobrar', 0) }}" onkeyup="format(this)" onchange="format(this)">
                </div>

                <div class="mb-4" id="h_tipo_cobro" style="display: none">
                    <label for="">Tipo de Cobro</label>
                    <select name="tipo_cobro" id="tipo_cobro" class="w-full rounded border-gray-400 enviar">
                        @foreach ($tipo_cobro as $item)
                            <option {{ (old('tipo_cobro') == $item->id ? 'selected' : '' ) }}  value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="mb-4">
                    <button type="button" id="generar" name="generar" class="mt-6 inline-block px-6 py-2.5 bg-green-500 text-white
                    font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-600 hover:shadow-lg
                    focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out"
                    onclick="btn_generar()">
                    Generar Cuota
                    </button>
                </div>

            </div>

        </div>

        <div class="flex flex-col mb-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table id="generacion_cuota" name="generacion_cuota" class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cuota</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Vencimiento</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cuota</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cuota Cobrado</th>
                                </tr>
                            </thead>

                            <tbody id="generacion_cuota_body">

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 pl-4">
            <button type="submit"
            class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded
            shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700
            active:shadow-lg transition duration-150 ease-in-out"
             value="">Guardar</button>
        </div>

    </form>

    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/moment_locale.js') }}"></script>
    <script src="{{ asset('js/crear_matricula.js') }}"></script>


</x-app-layout>
