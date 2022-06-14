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
                font-size: 13px;
                border: 1px solid black;
                border-collapse: collapse;
            }

            .content body{
                font-size: 10px;
                font-weight: lighter;
            }

            .content td{
                padding: 3px;
                line-height: 15px;
                font-size: 13px;
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
                        CONCEPTO: COBRO MATRICULA
                        <br style="margin-botton: 5px">
                        DESDE FECHA: {{date('d-m-Y', strtotime($search_desde_fecha))}} HASTA FECHA: {{date('d-m-Y', strtotime($search_hasta_fecha))}}
                        <br style="margin-botton: 5px">
                        GRADO: {{$grado->nombre}} - TURNO {{$turno->nombre}}
                    </th>
                </tr>
            </thead>
        </table>

        <div class="salto"></div>

        <table class="content">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Fecha</th>
                    <th>Forma de Cobro</th>
                    <th>Monto Total</th>
                </tr>

            </thead>
            @php
                $total = 0;
            @endphp
            <tbody>
                @foreach ($cobros as $item)
                    <tr>
                        <td style="text-align: left">
                            {{number_format($item->matricula->alumnos->cedula, 0, ".", ".")}} - {{ $item->matricula->alumnos->apellido }}, {{ $item->matricula->alumnos->nombre }}
                        </td>
                        <td style="text-align: center">{{ date('d/m/Y', strtotime($item->fecha_cobro)) }}</td>
                        <td style="text-align: left">{{ $item->cobros->forma_pago->nombre }}</td>
                        <td style="text-align: right">{{number_format($item->monto_cobrado_factura, 0, ".", ".")}}</td>
                        @php
                            $total = $total + $item->monto_cobrado_factura;
                        @endphp
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>

        <table class="content">

            <thead>
                <tr>
                    <th style="font-size: 16px" width="80%">TOTAL GENERAL</th>
                    <th style="font-size: 16px; text-align: right">{{number_format($total, 0, ".", ".")}}</th>
                </tr>
            </thead>
        </table>

    </body>

</html>
