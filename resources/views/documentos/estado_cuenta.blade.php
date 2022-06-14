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
                font-size: 13px;
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

            .espaciado{
                margin-top: 50px;
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
                        ESTADO DE CUENTA DEL ALUMNO
                        <br style="margin-botton: 5px">
                        CICLO: {{$ciclo->nombre}}
                    </th>
                </tr>
            </thead>
        </table>

        <div class="salto"></div>

        <div style="margin-bottom: 5px">
            Nombre y Apellido: <b>{{number_format($alumno->cedula, 0, ".", ".")}} - {{$alumno->nombre}} {{$alumno->apellido}}</b>
        </div>
        <div style="margin-bottom: 15px">
            Grado: <b>{{$alumno->grado->nombre}}</b> Turno: <b>{{$alumno->turno->nombre}}</b>
        </div>
        @if (!empty($matricula))
            @php
                $sub_total = 0;
                $total = 0;
            @endphp
            <table class="content">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Cuota</th>
                        <th>Fecha Cobro</th>
                        <th>Forma de Pago</th>
                        <th>Monto Cobrado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cobro_matricula as $item)
                        <tr>
                            <td>COBRO MATRICULA</td>
                            <td></td>
                            <td>{{date('d/m/Y', strtotime($item->cobros->fecha_cobro))}}</td>
                            <td>{{$item->cobros->forma_pago->nombre}}</td>
                            <td style="text-align: right">{{number_format($item->monto_cobrado_factura, 0, ".", ".")}}</td>
                            @php
                                $sub_total = $sub_total + $item->monto_cobrado_factura;
                                $total = $total + $item->monto_cobrado_factura;
                            @endphp
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" style="font-size: 14px"><b>SUB TOTAL - COBRO MATRICULA:</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($sub_total, 0, ".", ".")}}</b></td>
                    </tr>
                    @php
                        $sub_total = 0;
                    @endphp
                    @foreach ($cobro_matricula_cuota as $item)
                        <tr>
                            <td>COBRO CUOTA</td>
                            <td>{{$item->matricula_cuota->cuota}}</td>
                            <td>{{date('d/m/Y', strtotime($item->cobros->fecha_cobro))}}</td>
                            <td>{{$item->cobros->forma_pago->nombre}}</td>
                            <td style="text-align: right">{{number_format($item->monto_cobrado_cuota, 0, ".", ".")}}</td>
                            @php
                                $sub_total = $sub_total + $item->monto_cobrado_cuota;
                                $total = $total + $item->monto_cobrado_cuota;
                            @endphp
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" style="font-size: 14px"><b>SUB TOTAL - COBRO CUOTA:</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($sub_total, 0, ".", ".")}}</b></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align: left; font-size: 16px">TOTAL GENERAL EN CONCEPTO DE MATRICULA Y CUOTA</th>
                        <th style="text-align: right; font-size: 16px"><b>{{number_format($total, 0, ".", ".")}}</b></th>
                    </tr>
                </tfoot>

            </table>

        @endif

        <div style="page-break-before: always;"></div>

        <table class="cabezera">
            <thead>
                <tr>
                    <th class="">
                        <img src="{{ asset('escudo_5.jpg')}}" alt="">
                    </th>
                    <th style="width: 100%">
                        ESTADO DE CUENTA DEL ALUMNO
                        <br style="margin-botton: 5px">
                        CICLO: {{$ciclo->nombre}}
                    </th>
                </tr>
            </thead>
        </table>

        <div class="salto"></div>

        <div style="margin-bottom: 5px">
            Nombre y Apellido: <b>{{number_format($alumno->cedula, 0, ".", ".")}} - {{$alumno->nombre}} {{$alumno->apellido}}</b>
        </div>
        <div style="margin-bottom: 15px">
            Grado: <b>{{$alumno->grado->nombre}}</b> Turno: <b>{{$alumno->turno->nombre}}</b>
        </div>

        @if (!empty($cobro_ingreso))

            <h4 class="titulo">INGRESO VARIOS</h4>
            <table class="content">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Fecha Cobro</th>
                        <th>Forma de Pago</th>
                        <th>Monto Cobrado</th>
                    </tr>
                </thead>
                @php
                    $sub_total = 0;
                @endphp
                <tbody>
                    @foreach ($cobro_ingreso as $item)
                        <tr>
                            <td>{{$item->ingreso_concepto->nombre}}</td>
                            <td>{{date('d/m/Y', strtotime($item->cobros->fecha_cobro))}}</td>
                            <td>{{$item->cobros->forma_pago->nombre}}</td>
                            <td style="text-align: right">{{number_format($item->monto_cobrado_factura, 0, ".", ".")}}</td>
                            @php
                                $sub_total = $sub_total + $item->monto_cobrado_factura;
                                $total = $total + $item->monto_cobrado_factura;
                            @endphp
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" style="font-size: 14px"><b>TOTAL - INGRESO VARIOS:</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($sub_total, 0, ".", ".")}}</b></td>
                    </tr>
                </tbody>

            </table>

            <div class="espaciado"></div>

            <table class="content">

                <thead>
                    <tr>
                        <th style="font-size: 16px; text-align: left" width="80%">TOTAL GENERAL (MATRIULA + CUOTA + INGRESO VARIOS)</th>
                        <th style="font-size: 16px; text-align: right">{{number_format($total, 0, ".", ".")}}</th>
                    </tr>
                </thead>
            </table>

        @endif

    </body>

</html>
