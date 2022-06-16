<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <style>
            .caja-1 {
                margin: 0;
                width: 330px;
                border-style: solid;
                height: 8.2cm;
                padding: 5px;
                position: absolute;
                top: 0px;
                right: 0cm;
                bottom: 0cm;
                left: 0px;
            }

            .caja-2 {
                margin: 0;
                width: 330px;
                border-style: solid;
                height: 8.2cm;
                padding: 5px;
                position: absolute;
                top: 0px;
                right: 0px;
            }

            .caja-2 .bor{
                border-style: solid;
            }

            .caja-1 .bor{
                border-style: solid;
            }

            .title-1 {
                padding: 0;
                /* border-style: solid; */
                font-size: 10px;
                font-family: 'Segoe UI';
                height: 2cm;

            }

            .title-2 {
                padding: 0;
                /* border-style: solid; */
                font-size: 10px;
                font-family: 'Segoe UI';
                height: 2cm;

            }



            .title-1 p{
                margin-top: 0;
                margin-bottom: 2px;
                /* border-style: solid; */
                width: 150px
            }

            .title-2 p{
                margin-top: 0;
                margin-bottom: 2px;
                /* border-style: solid; */
                width: 150px
            }

            .title-1 .recibo{
                position: absolute;
                margin-left: 180px;
                margin-top: 5px;
                line-height: 20px;
                width: 170px;
                font-size: 14px;
                font-weight: bold;
                top: 0;
            }

            .title-2 .recibo{
                position: absolute;
                margin-left: 180px;
                margin-top: 5px;
                line-height: 20px;
                width: 170px;
                font-size: 14px;
                font-weight: bold;
                top: 0;
            }

            .content-1{
                padding: 0;
                height: 235px;
                width: 325px;
            }

            .content-2{
                padding: 0;
                height: 235px;
                width: 325px;
            }

            .content-1 p{
                margin-top: 5px;
                margin-left: 10px;
                margin-right: 10px;
                margin-bottom: 5px;
                font-size: 14px;
            }

            .content-2 p{
                margin-top: 5px;
                margin-left: 10px;
                margin-right: 10px;
                margin-bottom: 5px;
                font-size: 14px;
            }

            img{
                float: left;
            }

            .img-primero{
                width: 60px;
                height: 60px;
                padding: 0px;
                margin-right: 5px;
            }

            .img-segundo{
                width: 60px;
                height: 60px;
                padding: 0px;
                position: static;
                margin-left: 0cm;
                margin-right: 5px;
            }
            table{
                font-size: 13px;
                font-weight: lighter;
                margin-bottom: 5px;
            }

            tbody{
                padding-left: 10px;
                font-weight: lighter;
                /* border-style: solid; */
            }

            td{
                padding-left: 10px;
                /* border-style: solid; */
            }
        </style>
    </head>

    <body>

        <div class="caja-1">
            <div class="title-1">
                <img src="{{ asset('escudo.jpg') }}" alt="" class="img-primero">

                <p>
                    Dirección
                    <br>
                    Telef: (021) 999 999  (R.A.)
                    <br>
                    Fax: (021) 999 999
                    <br>
                    Asunción - Paraguay
                </p>

                <p class="recibo">
                    RECIBO DE DINERO
                    <br>
                    Emitido el: {{  date('d-m-Y', strtotime($cobro->cobros->fecha_cobro)) }}
                    <br>
                    N°: {{ number_format($cobro->cobros->id, 0, ".", ".") }}
                </p>

            </div>

            <div class="content-1">

                <table>

                    <tbody>
                        <tr style="">
                            <td style="border-bottom: 1px dotted black">{{ number_format($matricula_cuota->matricula->alumnos->cedula, 0, ".", ".") }} - </td>
                            <td style="width:180px; border-bottom: 1px dotted black">
                                {{$matricula_cuota->matricula->alumnos->nombre}} {{$matricula_cuota->matricula->alumnos->apellido}}
                            </td>
                            <td style=""></td>
                        </tr>
                        <tr style="">
                            <td style="">Documento - </td>
                            <td style="">Alumno</td>
                            <td style=""></td>
                        </tr>
                    </tbody>

                </table>

                <table>

                    <tbody>
                        <tr style="">
                            <td colspan="2" style="border-bottom: 1px dotted black">COBRO DE CUOTA DE ALUMNO</td>
                        </tr>
                        <tr style="">
                            <td style="">Concepto</td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr style="">
                            <td colspan="2" style="width: 195px; border-bottom: 1px dotted black; margin-left: 10px">
                                {{Str::upper(\Carbon\Carbon::parse($matricula_cuota->fecha_vencimiento)->translatedFormat('F'))}}{{ ($matricula_cuota->monto_cuota_cobrar == $cobro->monto_cobrado_cuota ? '' : ' - PARCIAL') }}
                            </td>
                            <td rowspan="2" style="padding: 0; width:50px; border-style: solid">
                                <p style="line-height: 15px; width: 70px; padding: 0; font-weight: bold">
                                    {{ number_format($cobro->monto_cobrado_cuota, 0, ".", ".") }}
                                </p>
                                <p style="width: 70px; padding: 0; font-size: 12px;">
                                    Total a Cobrar
                                </p>

                            </td>
                        </tr>
                        <tr style="">
                            <td style="">Mes de la Cuota</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr style="">
                            <td colspan="3" style="border-bottom: 1px dotted black">
                                @php
                                    if($cobro->monto_cobrado_cuota > 999999){
                                        $letra = 'DE GUARANIES';
                                    }else{
                                        $letra = ' GUARANIES';
                                    }
                                @endphp
                                {{$formatter->toMoney($cobro->monto_cobrado_cuota, 0, $letra , '');}}
                            </td>
                        </tr>
                        <tr style="">
                            <td colspan="2" style="">Total Cobrado (en letras)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 0;"><p style="font-size: 11px">No valido sin la firma y sello del cajero</p></td>
                            <td style="border-top: 1px solid black;">
                                Firma y Sello
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <div class="caja-2">

            <div class="title-2">
                <img src="{{ asset('escudo.jpg') }}" alt="" class="img-segundo">
                <p>
                    Dirección
                    <br>
                    Telef: (021) 999 999  (R.A.)
                    <br>
                    Fax: (021) 999 999
                    <br>
                    Asunción - Paraguay
                </p>

                <p class="recibo">
                    RECIBO DE DINERO
                    <br>
                    Emitido el: {{  date('d-m-Y', strtotime($cobro->cobros->fecha_cobro)) }}
                    <br>
                    N°: {{ number_format($cobro->cobros->id, 0, ".", ".") }}
                </p>
            </div>

            <div class="content-2">
                <table>

                    <tbody>
                        <tr style="">
                            <td style="border-bottom: 1px dotted black">{{ number_format($matricula_cuota->matricula->alumnos->cedula, 0, ".", ".") }} - </td>
                            <td style="width:180px; border-bottom: 1px dotted black">
                                {{$matricula_cuota->matricula->alumnos->nombre}} {{$matricula_cuota->matricula->alumnos->apellido}}
                            </td>
                            <td style=""></td>
                        </tr>
                        <tr style="">
                            <td style="">Documento - </td>
                            <td style="">Alumno</td>
                            <td style=""></td>
                        </tr>
                    </tbody>

                </table>

                <table>

                    <tbody>
                        <tr style="">
                            <td colspan="2" style="border-bottom: 1px dotted black">COBRO DE CUOTA DE ALUMNO</td>
                        </tr>
                        <tr style="">
                            <td style="">Concepto</td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr style="">
                            <td colspan="2" style="width: 195px; border-bottom: 1px dotted black; margin-left: 10px">
                                {{Str::upper(\Carbon\Carbon::parse($matricula_cuota->fecha_vencimiento)->translatedFormat('F'))}}{{ ($matricula_cuota->monto_cuota_cobrar == $cobro->monto_cobrado_cuota ? '' : ' - PARCIAL') }}
                            </td>
                            <td rowspan="2" style="padding: 0; width:50px; border-style: solid">
                                <p style="line-height: 15px; width: 70px; padding: 0; font-weight: bold">
                                    {{ number_format($cobro->monto_cobrado_cuota, 0, ".", ".") }}
                                </p>
                                <p style="width: 70px; padding: 0; font-size: 12px;">
                                    Total a Cobrar
                                </p>

                            </td>
                        </tr>
                        <tr style="">
                            <td style="">Mes de la Cuota</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr style="">
                            <td colspan="3" style="border-bottom: 1px dotted black">
                                @php
                                    if($cobro->monto_cobrado_cuota > 999999){
                                        $letra = 'DE GUARANIES';
                                    }else{
                                        $letra = ' GUARANIES';
                                    }
                                @endphp
                                {{$formatter->toMoney($cobro->monto_cobrado_cuota, 0, $letra , '');}}
                            </td>
                        </tr>
                        <tr style="">
                            <td colspan="2" style="">Total Cobrado (en letras)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-left: 0;"><p style="font-size: 11px">No valido sin la firma y sello del cajero</p></td>
                            <td style="border-top: 1px solid black;">
                                Firma y Sello
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>
        </div>



    </body>

</html>
