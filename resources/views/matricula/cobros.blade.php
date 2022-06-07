<x-app-layout>

    <div class="mb-2">
        <h2 class="text-center text-2xl font-semibold text-gray-600">Cobros</h2>
    </div>


    <div class="md:grid grid-cols-2 gap-4 px-4 py-6">

        <form action="{{route('cobros')}}" method="get">
            <div class="form-check mb-4">
                <input class=" form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white
                checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat
                bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="por_numero" id="por_numero">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                    Por N° de Cobro
                </label>
            </div>

            <div>
                <input class="" type="text" name="nro" id="nro" value="{{ $nro }}">
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white
                checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat
                bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="por_fecha" id="por_fecha">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                    Por Fecha
                </label>

            </div>

            <div>
                <input class="" type="date" name="fecha" id="fecha" value="{{ $fecha }}">
            </div>

            <div class="form-check mb-4 mt-5">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white
                checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat
                bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="todos" id="todos">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1" >
                    Todos los cobros
                </label>

            </div>

            <div>
                <button type="submit"
                class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded
                shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700
                active:shadow-lg transition duration-150 ease-in-out"
                value="">Buscar</button>
            </div>

        </form>
    </div>

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Nro Cobro</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cobro Concepto</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Cobro</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Total Cobrado</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($cobro as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ number_format($item->id, 0, ".", ".") }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $item->tipo_cobro->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{  date('d-m-Y', strtotime($item->fecha_cobro)) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ number_format($item->total_cobrado, 0, ".", ".") }}</td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>



</x-app-layout>
