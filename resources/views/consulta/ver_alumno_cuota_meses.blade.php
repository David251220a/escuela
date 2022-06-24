<x-app-layout>

    <h2 class="font-bold text-2xl mb-3">Cuotas</h2>

    <div>
        <label for="">Nombre y Apellido:
            <b>{{ number_format($alumno->cedula, 0, ".", ".") }} - {{ $alumno->nombre }} {{ $alumno->apellido }}</b>
        </label>
    </div>
    <div>
        <label for="" class="mr-2">Turno: <b>{{ $alumno->turno->nombre }}</b></label>
        <label for="" class="mr-2">Grado: <b>{{ $alumno->grado->nombre }}</b></label>
        <label for="">Ciclo: <b>{{ $matricula->ciclo->nombre }}</b></label>
    </div>
    <div class="mb-4">
        <label for="">Estado: <b class="{{($matricula->matricula_estado->id == 2 ? 'text-green-500' : 'text-red-500') }}">{{ $matricula->matricula_estado->nombre }}</b></label>
    </div>
    <div class="mb-4">
        <a href="{{ route('pdf.alumno_cuota_meses', $alumno) }}" class="border border-blue-500 text-blue-500 text-lg font-bold rounded py-2 px-4 mr-2" target="__blank">PDF</a>
        <a href="{{ route('consulta.alumno_cuota_meses') }}" class="border border-red-500 text-red-500 text-lg font-bold rounded py-2 px-4 mr-2">Volver</a>
    </div>

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            <tr>
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
                            <tr>
                                @for ($i = 2; $i <= 11; $i++)
                                    @php
                                        $total = 0;
                                        foreach ($matricula->cuotas as $cuota) {
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
                                    <td class="px-6 py-3 text-xs text-bold font-semibold uppercase tracking-wider text-right">{{$monto_cuota}}</td>
                                @endfor
                                <td class="px-6 py-3 text-xs text-bold font-semibold uppercase tracking-wider text-right">{{ number_format($total, 0, ".", ".")}}</td>

                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="9" class="px-6 py-3 text-lg text-bold font-bold uppercase tracking-wider text-left">Total General</td>
                                <td colspan="2" class="px-6 py-3 text-lg text-bold font-bold uppercase tracking-wider text-right">{{ number_format($total_general, 0, ".", ".")}}</td>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
