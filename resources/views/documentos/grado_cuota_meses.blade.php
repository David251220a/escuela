<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <style>
            .cabezera{
                padding: 0;
                margin: 0;
                /* border-style: solid; */
                position: absolute;
                width: 100%;
            }

            .cabezera th{
                /* border-style: solid; */
            }

            .cabezera img{
                height: 100px;
                width: 100px;
            }

            .content {
                margin-top: 140px;
                width: 100%;
                position: absolute;
                border: 1px solid black;
                border-collapse: collapse;
            }

            .content th{
                margin: 0;
                font-size: 13px;
                border: 1px solid black;
                border-collapse: collapse;
            }

            .content body{
                font-size: 12px;
                font-weight: lighter;
            }

            .content td{
                padding: 3px;
                font-size: 12px;
                line-height: 15px;
                border: 1px solid black;
                border-collapse: collapse;
            }

        </style>
    </head>

    <body>

        <table class="cabezera">
            <thead>
                <tr>
                    <th class="">
                        <img src="{{ asset('escudo_5.jpg')}}" alt="">
                    </th>
                    <th style="width: 100%">
                        CUOTAS MESES PAGADOS
                        <br style="margin-botton: 5px">
                        Grado: {{$grado->nombre}} - Turno: {{$turno->nombre}}
                        <br style="margin-botton: 5px">
                        Ciclo: {{$ciclo->nombre}}
                    </th>

                    {{-- <th class="">
                        <img src="{{ asset('logo_mec.jpg')}}" alt="" style="width: 200px;height: 200px; ">
                    </th> --}}
                </tr>
            </thead>
        </table>

        <table class="content">

            <thead>

                <tr>
                    <th>#</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Febrero</th>
                    <th>Marzo</th>
                    <th>Abril</th>
                    <th>Mayo</th>
                    <th>Junio</th>
                    <th>Julio</th>
                    <th>Agosto</th>
                    <th>Septiembre</th>
                    <th>Octubre</th>
                    <th>Noviembre</th>
                    <th>Total</th>
                </tr>

            </thead>

            <tbody>
                @php
                    $total_general = 0;
                    $totales_en_meses[2] = 0;
                    $totales_en_meses[3] = 0;
                    $totales_en_meses[4] = 0;
                    $totales_en_meses[5] = 0;
                    $totales_en_meses[6] = 0;
                    $totales_en_meses[7] = 0;
                    $totales_en_meses[8] = 0;
                    $totales_en_meses[9] = 0;
                    $totales_en_meses[10] = 0;
                    $totales_en_meses[11] = 0;
                @endphp
                @foreach ($alumnos as $item)
                    <tr>
                        <td style="text-align: right">{{$loop->iteration}}</td>
                        <td style="text-align: right">{{ number_format($item->cedula, 0, ".", ".") }}</td>
                        <td>{{$item->apellido }}, {{$item->nombre }}</td>
                        @php
                            $tiene_datos = 0;
                            $posicion = 0;
                            foreach($matriculas as $matricula){
                                if($matricula->alumno_id == $item->id){
                                    $tiene_datos = 1;
                                    // $posicion = $loop->iteration - 1;
                                    break;
                                }
                                $posicion = $posicion + 1;
                            }
                        @endphp
                        @if ($tiene_datos == 0)
                            <td colspan="11" style="text-align: center">No Matriculado</td>
                        @else
                            @php
                                $total = 0;
                                // $totales_en_meses[2] = 0;

                            @endphp

                            @for ($i = 2; $i <= 11; $i++)

                                @php
                                    foreach ($matriculas[$posicion]->cuotas as $cuota) {
                                        $mes_cuota = date('m', strtotime($cuota->fecha_vencimiento));
                                        if($i == intval($mes_cuota)){
                                            $monto_a_cobrar = number_format($cuota->monto_cuota_cobrar, 0, ".", ".");
                                            $monto_cuota = number_format($cuota->monto_cuota_cobrado, 0, ".", ".");
                                            $total = $total + $cuota->monto_cuota_cobrado;
                                            $total_general = $total_general + $cuota->monto_cuota_cobrado;
                                            $totales_en_meses[$i] = $totales_en_meses[$i] + $cuota->monto_cuota_cobrado;
                                            break;
                                        }else {
                                            $monto_cuota = '-';
                                        }
                                    }
                                @endphp
                                <td style="text-align: right; {{ ($monto_a_cobrar > $monto_cuota ? 'color: red;' : '') }}">{{$monto_cuota}}</td>
                            @endfor
                            <td style="text-align: right">{{ number_format($total, 0, ".", ".")}}</td>
                        @endif

                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                @php
                    $total_meses = 0;
                @endphp
                <tr>
                    <td colspan="3" style="text-align: left">Total en Meses</td>
                    @for ($i = 2; $i <= 11; $i++)
                        <td style="text-align: right">{{ number_format($totales_en_meses[$i], 0, ".", ".")}}</td>
                        @php
                            $total_meses = $total_meses + $totales_en_meses[$i];
                        @endphp
                    @endfor
                    <td style="text-align: right">{{ number_format($total_meses, 0, ".", ".")}}</td>
                </tr>
                <tr>
                    <td colspan="12" style="text-align: left; padding: 2px; font-weight: bold">TOTAL GENERAL</td>
                    <td colspan="2" style="text-align: right; font-weight: bold">{{ number_format($total_general, 0, ".", ".")}}</td>
                </tr>
            </tfoot>

        </table>

    </body>

</html>
