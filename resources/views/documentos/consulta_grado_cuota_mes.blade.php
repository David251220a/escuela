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
                font-size: 12px;
                font-weight: lighter;
            }

            .content td{
                padding: 3px;
                line-height: 15px;
                font-size: 12.5px;
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
                        INGRESO CUOTA MES DE {{Str::upper(\Carbon\Carbon::parse($cobros[0]->fecha_vencimiento)->translatedFormat('F'))}}
                        <br style="margin-botton: 5px">
                        {{$grado->nombre}} - TURNO {{$turno->nombre}}
                    </th>
                </tr>
            </thead>
        </table>

        <div class="salto"></div>
        @if (count($alumno) > 0)

            <table class="content">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Nombre y Apellido</th>
                        <th>Mes Cuota</th>
                        <th>Fecha Cobro</th>
                        <th>Monto a Cobrar</th>
                        <th>Monto Cobrado</th>
                        <th>Saldo</th>
                    </tr>

                </thead>
                @php
                    $suma = 0;
                    $total = 0;
                    $tiene = 0;
                @endphp
                <tbody>
                    @php
                        $total_cobrar = 0;
                        $total_cobrado = 0;
                        $saldo = 0;
                    @endphp
                    @foreach ($alumno as $item)
                        <tr>
                            <td style="text-align: right">{{ number_format($item->cedula, 0, ".", ".") }}</td>
                            <td style="text-align: left">{{ $item->nombre }} {{ $item->apellido }}</td>
                            @foreach ($cobros as $cobro)
                                @if ($cobro->matricula->alumno_id == $item->id)
                                    @php
                                        $pintar = ($cobro->monto_cuota_cobrado == $cobro->monto_cuota_cobrar ? 0 : 1);
                                        $total_cobrado = $total_cobrado + $cobro->monto_cuota_cobrado;
                                        $total_cobrar = $total_cobrar + $cobro->monto_cuota_cobrar;
                                    @endphp
                                    <td style="text-align: center; {{ ($pintar == 1 ? 'background: rgb(211, 84, 84)' : '') }}">
                                        {{Str::upper(\Carbon\Carbon::parse($cobro->fecha_vencimiento)->translatedFormat('F'))}}
                                    </td>
                                    <td style="text-align: center; {{ ($pintar == 1 ? 'background: rgb(211, 84, 84)' : '') }}">
                                        {{ (count($cobro->cuota_pagada) == 0 ? '' : date('d/m/Y', strtotime($cobro->cuota_pagada[0]->cobros->fecha_cobro)))  }}

                                    </td>

                                    <td style="text-align: right; {{ ($pintar == 1 ? 'background: rgb(211, 84, 84)' : '') }}">
                                        {{ number_format($cobro->monto_cuota_cobrar, 0, ".", ".") }}
                                    </td>
                                    <td style="text-align: right; {{ ($pintar == 1 ? 'background: rgb(211, 84, 84)' : '') }}">
                                        {{ number_format($cobro->monto_cuota_cobrado, 0, ".", ".") }}
                                    </td>
                                    <td style="text-align: right; {{ ($pintar == 1 ? 'background: rgb(211, 84, 84)' : '') }}">
                                        {{ number_format($cobro->saldo, 0, ".", ".") }}
                                    </td>

                                    @break

                                @endif

                            @endforeach
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td style="font-size: 16px; padding-top: 5px;padding-left: 3px; padding-bottom: 5px; font-weight: bold" colspan="4">TOTALES</td>
                        <td style="font-size: 16px; text-align: right ; font-weight: bold">{{number_format($total_cobrar, 0, ".", ".")}}</td>
                        <td style="font-size: 16px; text-align: right ; font-weight: bold">{{number_format($total_cobrado, 0, ".", ".")}}</td>
                        <td style="font-size: 16px; text-align: right ; font-weight: bold">{{number_format($total_cobrar - $total_cobrado, 0, ".", ".")}}</td>
                    </tr>
                </tfoot>
            </table>

        @endif


    </body>

</html>
