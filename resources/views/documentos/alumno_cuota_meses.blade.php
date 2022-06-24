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
                margin-top: 5px;
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

            .salto{
                margin-top: 125px;
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
                        Grado: {{$alumno->grado->nombre}} - Turno: {{$alumno->turno->nombre}}
                        <br style="margin-botton: 5px">
                        Ciclo: {{$alumno->ciclo->nombre}}
                    </th>

                    {{-- <th class="">
                        <img src="{{ asset('logo_mec.jpg')}}" alt="" style="width: 200px;height: 200px; ">
                    </th> --}}
                </tr>
            </thead>
        </table>

        <div class="salto"></div>

        <div style="margin-bottom: 5px">
            Nombre y Apellido: <b>{{number_format($alumno->cedula, 0, ".", ".")}} - {{$alumno->nombre}} {{$alumno->apellido}}</b>
        </div>
        <div class="mb-4">
            Estado: <b style="{{($matricula->matricula_estado->id == 2 ? 'color: green' : 'color: red') }}">{{ $matricula->matricula_estado->nombre }}</b>
        </div>

        <br>

        <table class="content">

            <thead>

                <tr>
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
                @endphp
                <tr>
                    @for ($i = 2; $i <= 11; $i++)
                        @php
                            $total = 0;
                            foreach ($matricula->cuotas as $cuota) {
                                $mes_cuota = date('m', strtotime($cuota->fecha_vencimiento));
                                if($i == intval($mes_cuota)){
                                    $monto_cuota = number_format($cuota->monto_cuota_cobrado, 0, ".", ".");
                                    $monto_a_cobrar = $cuota->monto_cuota_cobrar;
                                    $aux_monto_cuota = $cuota->monto_cuota_cobrado;
                                    $total = $total + $cuota->monto_cuota_cobrado;
                                    $total_general = $total_general + $cuota->monto_cuota_cobrado;
                                    $monto_a_cobrar = $cuota->monto_cuota_cobrado;
                                    break;
                                }else {
                                    $monto_cuota = '-';
                                }
                            }
                        @endphp
                        <td style="text-align: right; {{ ($monto_a_cobrar > $aux_monto_cuota ? 'color: red;' : '') }}">{{$monto_cuota}}</td>
                    @endfor
                    <td style="text-align: right">{{ number_format($total, 0, ".", ".")}}</td>
                </tr>
            </tbody>

            {{-- <tfoot>
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
            </tfoot> --}}

        </table>

    </body>

</html>
