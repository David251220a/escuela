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
                $cobro_matricula_cont = 0;
                $forma_pago = '';
                $fecha = '';
                $monto_matriculacion= 0;
                $pinto = 0;
                $cobrar = 0;
                $cobrado = 0;
                $saldo = 0;
                $multa = 0;
            @endphp
            <table class="content">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Cuota</th>
                        <th>Fecha Cobro</th>
                        <th>Monto a Cobrar</th>
                        <th>Monto Cobrado</th>
                        <th>Monto Saldo</th>
                        <th>Multa</th>
                        <th>Total Cobrado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cobro_matricula as $item)
                        @php
                            $cobro_matricula_cont = $cobro_matricula_cont + $item->monto_cobrado_factura;
                            $forma_pago = $item->cobros->forma_pago->nombre;
                            $fecha = date('d/m/Y', strtotime($item->cobros->fecha_cobro));
                        @endphp
                    @endforeach
                    <tr style="{{ ($cobro_matricula_cont == $matricula->monto_matricula ? '' : 'color: rgb(220, 38, 38)') }}">
                        <td>COBRO MATRICULA</td>
                        <td></td>
                        <td>{{ $fecha }}</td>
                        <td style="text-align: right">{{number_format($matricula->monto_matricula, 0, ".", ".")}}</td>
                        <td style="text-align: right">{{number_format($cobro_matricula_cont, 0, ".", ".")}}</td>
                        <td style="text-align: right">{{number_format($matricula->monto_matricula - $cobro_matricula_cont, 0, ".", ".")}}</td>
                        <td style="text-align: right">0</td>
                        <td style="text-align: right">{{number_format($cobro_matricula_cont, 0, ".", ".")}}</td>
                        @php
                            $sub_total = $sub_total + $cobro_matricula_cont;
                            $total = $total + $cobro_matricula_cont;
                        @endphp
                    </tr>
                    <tr>
                        <td colspan="3" style="font-size: 14px"><b>SUB TOTAL - COBRO MATRICULA:</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($matricula->monto_matricula, 0, ".", ".")}}</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($sub_total, 0, ".", ".")}}</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($matricula->monto_matricula - $cobro_matricula_cont, 0, ".", ".")}}</b></td>
                        <td style="text-align: right; font-size: 14px"><b>0</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($sub_total, 0, ".", ".")}}</b></td>
                    </tr>
                    @php
                        $sub_total = 0;
                    @endphp
                    @foreach ($matricula->cuotas as $item)
                        @php
                            $pintar = ( $item->monto_cuota_cobrar == $item->monto_cuota_cobrado ? '0' : '1');

                        @endphp
                        <tr style="{{ ($pintar == 1 ? 'color: rgb(220, 38, 38)' : '') }}">
                            <td>COBRO CUOTA</td>
                            <td>{{ Str::upper(\Carbon\Carbon::parse($item->fecha_vencimiento)->translatedFormat('F')) }}</td>
                            <td>
                                {{ (empty($item->cobro_cuota->cobros->fecha_cobro) ? '' : date('d/m/Y', strtotime($item->cobro_cuota->cobros->fecha_cobro ))) }}
                            </td>
                            <td style="text-align: right">{{number_format($item->monto_cuota_cobrar, 0, ".", ".")}}</td>
                            <td style="text-align: right">{{number_format($item->monto_cuota_cobrado, 0, ".", ".")}}</td>
                            <td style="text-align: right">{{number_format($item->monto_cuota_cobrar - $item->monto_cuota_cobrado, 0, ".", ".")}}</td>
                            <td style="text-align: right">{{number_format($item->monto_multa_cobrado, 0, ".", ".")}}</td>
                            <td style="text-align: right">{{number_format($item->monto_cobrado, 0, ".", ".")}}</td>
                            @php
                                $sub_total = $sub_total + $item->monto_cuota_cobrado;
                                $total = $total + $item->monto_cuota_cobrado + $item->monto_multa_cobrado;
                                $cobrar = $cobrar + $item->monto_cuota_cobrar;
                                $cobrado = $cobrado + $item->monto_cuota_cobrado;
                                $saldo = $item->monto_cuota_cobrar - $item->monto_cuota_cobrado;
                                $multa = $multa + $item->monto_multa_cobrado;
                            @endphp
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" style="font-size: 14px"><b>SUB TOTAL - COBRO CUOTA:</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($cobrar, 0, ".", ".")}}</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($cobrado, 0, ".", ".")}}</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($saldo, 0, ".", ".")}}</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($multa, 0, ".", ".")}}</b></td>
                        <td style="text-align: right; font-size: 14px"><b>{{number_format($cobrado + $multa, 0, ".", ".")}}</b></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7" style="text-align: left; font-size: 16px">TOTAL GENERAL EN CONCEPTO DE MATRICULA Y CUOTA</th>
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
