<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <style>
            .caja-1 {
                margin: 0;
                width: 330px;
                border-style: solid;
                height: 8cm;
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
                height: 8cm;
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

            .title-1 p{
                margin-top: 0;
                margin-bottom: 2px;
                /* border-style: solid; */
                width: 150px
            }

            .title-1 .recibo{
                position: absolute;
                margin-left: 160px;
                margin-top: 5px;
                line-height: 20px;
                width: 170px;
                font-size: 14px;
                font-weight: bold;
                top: 0;
            }

            .content-1{
                padding: 0;
                border-style: solid;
                height: 200px;
                width: 325px;
            }

            .content-1 p{
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
            }
            table{
                font-size: 13px;
                font-weight: lighter;
                margin-bottom: 5px;
            }

            tbody{
                padding-left: 10px;
                font-weight: lighter;
                border-style: solid;
            }

            td{
                padding-left: 10px;
                border-style: solid;
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
                    Emitido el: 05/06/2022
                    <br>
                    N°: 251234
                </p>

            </div>

            <div class="content-1">
                {{-- <p style="border-bottom: 1px dotted black;">
                    4.918.642 David Emmanuel Ortiz Mieres
                </p>
                <p style="font-size: 13.5px">Documento -  Alumno</p> --}}
                <table>

                    <tbody>
                        <tr style="">
                            <td style="">4.918.642 - </td>
                            <td style="width:180px">David Emmanuel Ortiz Mieres</td>
                            <td style=""></td>
                        </tr>
                        <tr style="">
                            <td style="">Documento - </td>
                            <td style="width:150px">Alumno</td>
                            <td style=""></td>
                        </tr>
                    </tbody>

                </table>
                <table>

                    <tbody>
                        <tr style="">
                            <td style="">COBRO DE CUOTA DE ALUMNO</td>
                        </tr>
                        <tr style="">
                            <td style="">Concepto</td>
                        </tr>
                    </tbody>

                </table>

                <table>

                    <tbody>
                        <tr style="">
                            <td style="width: 180px">MARZO</td>
                            <td rowspan="2" style="padding: 0; width:50px;">
                                <p style="line-height: 15px; width: 70px; padding: 0; font-weight: bold">
                                    260.000
                                </p>
                                <p style="width: 70px; padding: 0; font-size: 12px;">
                                    Total a Cobrar
                                </p>

                            </td>
                        </tr>
                        <tr style="">
                            <td style="">mes de la cuota</td>

                        </tr>
                        <tr>

                        </tr>
                    </tbody>

                </table>

                <table>

                    <tbody>
                        <tr style="">
                            <td style="">DOSCIENTOS SESENTA MIL GUARANIES</td>
                        </tr>
                        <tr style="">
                            <td style="">Total Cobrado (en letras)</td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>

        <div class="caja-2">
            <img src="{{ asset('escudo.jpg') }}" alt="" class="img-segundo">
        </div>



    </body>

</html>
