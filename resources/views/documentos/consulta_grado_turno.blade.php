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
                margin-top: 140px;
                width: 100%;
                position: absolute;
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
                        REPORTE DE ALUMNOS
                        <br style="margin-botton: 5px">
                        Grado: {{$grado->nombre}} - Turno: {{$turno->nombre}}
                        <br style="margin-botton: 5px">
                        Ciclo: {{$aux_ciclo->nombre}}
                    </th>
                </tr>
            </thead>
        </table>

        <table class="content">

            <thead>

                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">Documento</th>
                    <th style="width: 60%">Alumno</th>
                    <th style="width: 12%">Fecha Nacimiento</th>
                    <th style="width: 5%">Edad</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($alumno as $item)
                    <tr>
                        <td style="text-align: right">{{$loop->iteration}}</td>
                        <td style="text-align: right">{{ number_format($item->cedula, 0, ".", ".") }}</td>
                        <td>{{$item->apellido }}, {{$item->nombre }}</td>
                        <td style="text-align: center">{{ date('d/m/Y', strtotime($item->fecha_nacimiento)) }}</td>
                        @php
                            $edad = date_diff(date_create($item->fecha_nacimiento), date_create(Carbon\Carbon::now()));
                        @endphp
                        <td style="text-align: center">{{ $edad->y }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </body>

</html>
