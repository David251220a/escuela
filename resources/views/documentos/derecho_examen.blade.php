<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <style>

            body {
                /* margin: 2cm 1cm 1cm; */
                margin-top: 0;
                margin-bottom: 1cm;
                height: 100%;
                width: 100%;
            }

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
                margin-top: 0;
                margin-bottom: 0;
                width: 100%;
                /* height: 100%;
                position: absolute; */
                border: 1px solid black;
                border-collapse: collapse;
            }

            .content th{
                margin: 0;
                font-size: 14px;
                border: 1px solid black;
                border-collapse: collapse;
            }

            .content body{
                font-size: 13px;
                font-weight: lighter;
            }

            .content td{
                padding: 3px;
                line-height: 15px;
                border: 1px solid black;
                border-collapse: collapse;
            }

            .content tfoot{
                font-size: 15px;
            }

            .titulo{
                text-align: center;
                margin-top: 25px;
                margin-bottom: 0;
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
                        REPORTE DE INGRESO
                        <br style="margin-botton: 5px">
                        CONCEPTO: {{$titulo}}
                        <br style="margin-botton: 5px">
                        {{$grado_aux->nombre}} - TURNO {{$turno_aux->nombre}}
                    </th>
                </tr>
            </thead>
        </table>

        <div class="salto"></div>
        @if (count($alumno) > 0)

            <h4 class="titulo">{{$aux_titulo->nombre}}</h4>

            <table class="content">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Alumno</th>
                        <th>Fecha</th>
                        <th>Monto a Pagar</th>
                        <th>Monto Pagado</th>
                    </tr>

                </thead>
                @php
                    $suma = 0;
                    $total = 0;
                    $pagar = 0;
                    $tiene = 0;
                @endphp
                <tbody>
                    @foreach ($alumno as $item)
                        @php
                            $tiene = 0;
                            $nombre = '';
                            $monto_total = 0;
                            $monto_a_pagar = 0;
                        @endphp
                        @foreach ($cobros as $cobro)
                            @if ($cobro->alumno_id == $item->id)
                                @php
                                    $tiene = 1;
                                    $monto_total = $monto_total + $cobro->monto_cobrado_factura;
                                    $monto_a_pagar = $cobro->precio;
                                @endphp
                            @endif

                        @endforeach
                        @if ($monto_a_pagar == 0)
                            @php
                                $monto_a_pagar = $aux_titulo->precio;
                            @endphp
                        @endif
                        <tr style="{{ ($monto_a_pagar != $monto_total ? 'background: rgb(199, 199, 196)' : '') }}">
                            <td style="text-align: right">{{number_format($item->cedula, 0, ".", ".")}}</td>
                            <td style="text-align: left">{{ $item->apellido }}, {{ $item->nombre }}</td>
                            <td style="text-align: center">{{ date('d/m/Y', strtotime($cobro->fecha_cobro)) }}</td>
                            <td style="text-align: right">{{number_format($monto_a_pagar, 0, ".", ".")}}</td>
                            <td style="text-align: right">{{number_format($monto_total, 0, ".", ".")}}</td>
                            @php
                                $total = $total + $monto_total;
                                $pagar = $pagar + $monto_a_pagar;
                            @endphp
                        </tr>

                    @endforeach
                </tbody>
            </table>

            <br>

            <table class="content">

                <thead>
                    <tr>
                        <th style="font-size: 16px" width="63%">TOTAL GENERAL</th>
                        <th style="font-size: 16px; text-align: right">{{number_format($pagar, 0, ".", ".")}}</th>
                        <th style="font-size: 16px; text-align: right">{{number_format($total, 0, ".", ".")}}</th>
                    </tr>
                </thead>
            </table>

        @endif


    </body>

</html>
