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
                        DESDE FECHA: {{date('d-m-Y', strtotime($fecha_desde))}} HASTA FECHA: {{date('d-m-Y', strtotime($fecha_hasta))}}
                        <br style="margin-botton: 5px">
                        {{$grado_aux->nombre}} - TURNO {{$turno_aux->nombre}}
                    </th>
                </tr>
            </thead>
        </table>

        <div class="salto"></div>
        @if (!empty($cobros))

            @php
                $suma = 0;
                $total = 0;
            @endphp

            @foreach ($tipo_ingreso as $tipo)

                <h4 class="titulo">{{$tipo->ingreso_concepto->nombre}}</h4>

                <table class="content">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Alumno</th>
                            <th>Fecha</th>
                            <th>Monto Total</th>
                        </tr>

                    </thead>

                    <tbody>
                        @foreach ($cobros as $item)
                            @if ($item->cobro_ingreso_concepto == $tipo->cobro_ingreso_concepto)
                                <tr>
                                    <td style="text-align: right">{{number_format($item->alumno->cedula, 0, ".", ".")}}</td>
                                    <td style="text-align: left">{{ $item->alumno->apellido }}, {{ $item->alumno->nombre }}</td>
                                    <td style="text-align: center">{{ date('d/m/Y', strtotime($item->fecha_cobro)) }}</td>
                                    <td style="text-align: right">{{number_format($item->monto_cobrado_factura, 0, ".", ".")}}</td>
                                </tr>
                                @php
                                    $suma = $suma + $item->monto_cobrado_factura
                                @endphp
                            @endif
                            @php
                                $total = $total + $item->monto_cobrado_factura;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: left; font-weight: bold">SUB TOTAL - {{$tipo->ingreso_concepto->nombre}}:</td>
                            <td style="text-align: right; font-weight: bold">{{number_format($suma, 0, ".", ".")}}</td>
                        </tr>
                    </tfoot>
                </table>
                {{-- <div style="page-break-before: always;"></div> --}}
            @endforeach
            <br>

            <table class="content">

                <thead>
                    <tr>
                        <th style="font-size: 16px" width="80%">TOTAL GENERAL</th>
                        <th style="font-size: 16px; text-align: right">{{number_format($total, 0, ".", ".")}}</th>
                    </tr>
                </thead>
            </table>

        @endif



    </body>

</html>
