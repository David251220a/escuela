<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <style>
            .caja-1 {
                margin: 0;
                width: 340px;
                border-style: solid;
                height: 8.7cm;
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
                height: 8.7cm;
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
                width: 176px
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
                width: 100%;
            }

            .content-2{
                padding: 0;
                height: 235px;
                width: 100%;
            }

            .content-1 p{
                margin-top: 5px;
                margin-left: 10px;
                margin-right: 2 px;
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
                width: 100%;
            }

            tbody{
                padding-left: 10px;
                font-weight: lighter;
                width: 100%;
                /* border-style: solid; */
            }

            td{
                padding-left: 10px;
                /* border-style: solid; */
            }

            .mi-texto{
                font-size: 15px;
                font-weight: 700;
            }

            .mi-detalle{
                font-size: 11px;
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
                    Emitido el: {{  date('d-m-Y', strtotime($cobros->fecha_cobro)) }}
                    <br>
                    N°: {{ number_format($cobros->id, 0, ".", ".") }}
                </p>

            </div>

            <div class="content-1">

                <table>

                    <tbody style="width: 100%">
                        <tr style="">
                            <td style="border-bottom: 1px dotted black">{{ number_format($alumno->cedula, 0, ".", ".") }} - </td>
                            <td style="width:180px; border-bottom: 1px dotted black">
                                {{$alumno->nombre}} {{$alumno->apellido}}
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

                    <tbody style="width: 100%;">
                        <tr style="">
                            <td class="mi-texto">
                                Detalle
                            </td>
                            <td></td>
                        </tr>
                        @foreach ($cobros_detalle as $item)
                            <tr>
                                <td colspan="2" style="text-align: left; font-size: 10px">
                                    {{$item->ingreso_concepto->nombre}}
                                </td>
                                <td style="text-align: left; font-size: 10px">
                                    {{number_format($item->monto_cobrado_factura, 0, ".", ".")}}
                                    {{ ($item->monto_saldo_factura == 0 ? '' : ' - PAGO PARCIAL' ) }}
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr style="">
                            <td colspan="2">
                            </td>
                            <td rowspan="2" style="padding: 0; width:50px; border-style: solid">
                                <p style="line-height: 10px; width: 70px; padding: 0; font-weight: bold">
                                    {{ number_format($cobros->total_cobrado, 0, ".", ".") }}
                                </p>
                                <p style="width: 90px; padding: 0; font-size: 12px;text-align = center;">
                                    =Total a Cobrar
                                </p>

                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr style="">
                            <td colspan="3" style="border-bottom: 1px dotted black">
                                @php
                                    if($cobros->total_cobrado > 999999){
                                        $letra = 'DE GUARANIES';
                                    }else{
                                        $letra = ' GUARANIES';
                                    }
                                @endphp
                                {{$formatter->toMoney($cobros->total_cobrado, 0, $letra , '');}}
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
                    Emitido el: {{  date('d-m-Y', strtotime($cobros->fecha_cobro)) }}
                    <br>
                    N°: {{ number_format($cobros->id, 0, ".", ".") }}
                </p>

            </div>

            <div class="content-2">

                <table>

                    <tbody>
                        <tr style="">
                            <td style="border-bottom: 1px dotted black">{{ number_format($alumno->cedula, 0, ".", ".") }} - </td>
                            <td style="width:180px; border-bottom: 1px dotted black">
                                {{$alumno->nombre}} {{$alumno->apellido}}
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
                            <td colspan="2" class="mi-texto">
                                Detalle
                            </td>
                        </tr>
                        @foreach ($cobros_detalle as $item)
                            <tr class="mi-detalle">
                                <td colspan="2" style="text-align: left; font-size: 10px">
                                    {{$item->ingreso_concepto->nombre}}
                                </td>
                                <td style="text-align: left; font-size: 10px">
                                    {{number_format($item->monto_cobrado_factura, 0, ".", ".")}}
                                    {{ ($item->monto_saldo_factura == 0 ? '' : ' - PAGO PARCIAL' ) }}
                                </td>

                            </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr style="">
                            <td colspan="2">
                            </td>
                            <td rowspan="2" style="padding: 0; width:50px; border-style: solid">
                                <p style="line-height: 10px; width: 70px; padding: 0; font-weight: bold">
                                    {{ number_format($cobros->total_cobrado, 0, ".", ".") }}
                                </p>
                                <p style="width: 90px; padding: 0; font-size: 12px;text-align = center;">
                                    =Total a Cobrar
                                </p>

                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr style="">
                            <td colspan="3" style="border-bottom: 1px dotted black">
                                @php
                                    if($cobros->total_cobrado > 999999){
                                        $letra = 'DE GUARANIES';
                                    }else{
                                        $letra = ' GUARANIES';
                                    }
                                @endphp
                                {{$formatter->toMoney($cobros->total_cobrado, 0, $letra , '');}}
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
                            <td colspan="2" style="padding-left: 0;"><p style="font-size: 10px">No valido sin la firma y sello del cajero</p></td>
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
