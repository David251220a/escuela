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
                margin-top: 5px;
                width: 100%;
                position: relative;
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
                font-size: 12px;
                font-weight: lighter;
            }

            .content td{
                padding: 3px;
                font-size: 12px;
                line-height: 15px;
                border: 1px solid black;
                border-collapse: collapse;
            }

            .salto{
                margin-top: 125px;
            }

            p{
                font-size: 15px;
                line-height: 10px;
                margin-top: 10px;
                margin-bottom: 10px;
                margin-left: 2px;
                padding: 0;
            }

            tfoot{
                margin-left: 2px;
                padding: 0;
            }

            div.gallery{
                width: 300px;
                height: 400px;
                border-radius: 13px;

            }

            div.container {
                text-align: center;
                padding: 10px 20px;
                font-size: 13px;
                line-height: 5px;
            }

            .card-img{
                width: 300px;
                height: 300px;
                border-radius: 13px;
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
                        FICHA ALUMNO
                    </th>
                </tr>
            </thead>
        </table>
        <div class="salto"></div>

        <div style="margin-bottom: 10px">
            <table>
                <thead>
                    <tr>
                        <th>
                            <img src="{{ asset(Storage::url($alumno->foto))}}" alt="" style="border-radius: 50px;width:125px;height:125px">
                        </th>
                        <th style="margin-top: -55px;width:100%; padding:0; text-align:left; font-size:15px">
                            Cedula: {{ number_format($alumno->cedula, 0, ".", ".") }}
                            <br>
                            Nombre: {{$alumno->nombre}}
                            <br>
                            Apellido: {{$alumno->apellido}}
                            <br>
                            Grado: {{$alumno->grado->nombre}} - Turno: {{$alumno->turno->nombre}}
                            <br>
                            Ciclo: {{$alumno->ciclo->nombre}}
                        </th>
                    </tr>
                </thead>
            </table>
        </div>

        <div style="margin-bottom:15px">
            <table class="content">
                <thead>
                    <tr>
                        <th colspan="2">Datos del Alumno</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>
                                Fecha Nacimiento: <b>{{ date('d/m/Y', strtotime($alumno->fecha_nacimiento))  }}</b>
                            </p>
                            <p>
                                @php
                                    $edad = date_diff(date_create($alumno->fecha_nacimiento), date_create(Carbon\Carbon::now()));
                                @endphp
                                Edad : <b>{{ $edad->y}} años</b>
                            </p>
                            <p>
                                Sexo: <b>{{ ($alumno->sexo == 1 ? 'MASCULINO' : 'FEMENINO')  }}</b>
                            </p>
                            <p>
                                Lugar de Nacimiento: <b>{{ $alumno->lugar_nacimiento->nombre  }}</b>
                            </p>
                            <p>
                                Dirección: <b>{{ $alumno->direccion  }}</b>
                            </p>
                        </td>
                        <td>
                            <p>
                                Cantidad Hermano: <b>{{ $alumno->cantidad_hermanos }}</b>
                            </p>
                            <p>
                                Linea Baja: <b>{{ $alumno->telefono_baja }}</b>
                            </p>
                            <p>
                                Celular: <b>{{ $alumno->telefono }}</b>
                            </p>
                            <p>
                                Alergia: <b>{{ $alumno->alergia->nombre }}</b>
                            </p>
                            <p>
                                Seguro: <b>{{ $alumno->seguro->nombre }}</b>
                            </p>
                            <p>
                                Enfermedad: <b>{{ $alumno->enfermedad->nombre }}</b>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Observación: <b>{{ $alumno->observacion_enfermedad }}</b></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="margin-bottom:15px">
            <table class="content">
                <thead>
                    <th colspan="2">Datos de la Madre</th>
                </thead>
                <tbody>
                    <tr>
                        <td width="50%">
                            <p>
                                Cedula: <b>{{ number_format($alumno->madre->cedula, 0, ".", ".") }}</b>
                            </p>
                            <p>
                                Nombre: <b>{{ $alumno->madre->nombre }}</b>
                            </p>
                            <p>
                                Apellido: <b>{{ $alumno->madre->apellido }}</b>
                            </p>
                            <p>
                                Telefono : <b>{{ $alumno->madre->telefono_wapp }}</b>
                            </p>
                            <p>
                                Telefono Particular: <b>{{ $alumno->madre->telefono_particular }}</b>
                            </p>
                        </td>
                        <td width="50%">
                            <p>
                                Dirección: <b>{{ $alumno->madre->direccion  }}</b>
                            </p>
                            <p>
                                Lugar de Trabajo: <b>{{ $alumno->madre->lugar_trabajo }}</b>
                            </p>
                            <p>
                                Dias de Trabajo: <b>{{ $alumno->madre->horario_dias_trabajo }}</b>
                            </p>
                            <p>
                                Telefono Laboral: <b>{{ $alumno->madre->telefono_laboral }}</b>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table class="content">
                <thead>
                    <th colspan="2">Datos del Padre</th>
                </thead>
                <tbody>
                    <tr>
                        <td width="50%">
                            <p>
                                Cedula: <b>{{ number_format($alumno->padre->cedula, 0, ".", ".") }}</b>
                            </p>
                            <p>
                                Nombre: <b>{{ $alumno->padre->nombre }}</b>
                            </p>
                            <p>
                                Apellido: <b>{{ $alumno->padre->apellido }}</b>
                            </p>
                            <p>
                                Telefono : <b>{{ $alumno->padre->telefono_wapp }}</b>
                            </p>
                            <p>
                                Telefono Particular: <b>{{ $alumno->padre->telefono_particular }}</b>
                            </p>
                        </td>
                        <td width="50%">
                            <p>
                                Dirección: <b>{{ $alumno->padre->direccion  }}</b>
                            </p>
                            <p>
                                Lugar de Trabajo: <b>{{ $alumno->padre->lugar_trabajo }}</b>
                            </p>
                            <p>
                                Dias de Trabajo: <b>{{ $alumno->padre->horario_dias_trabajo }}</b>
                            </p>
                            <p>
                                Telefono Laboral: <b>{{ $alumno->padre->telefono_laboral }}</b>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="page-break-before: always;"></div>

        <div style="margin-bottom:15px">
            <table class="content">
                <thead>
                    <tr>
                        <th colspan="2">Datos del Encargado</th>
                    </tr>
                    <tr>
                        <th>Encargado 1</th>
                        <th>Encargado 2</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="50%">
                            <p>
                                Cedula: <b>{{ number_format($alumno->encargado->cedula, 0, ".", ".") }}</b>
                            </p>
                            <p>
                                Nombre: <b>{{ $alumno->encargado->nombre }}</b>
                            </p>
                            <p>
                                Parentezco: <b>{{ $alumno->encargado->parentezco }}</b>
                            </p>
                            <p>
                                Telefono: <b>{{ $alumno->encargado->telefono  }}</b>
                            </p>
                            <p>
                                Observación: <b>{{ $alumno->encargado->observacion  }}</b>
                            </p>
                        </td>
                        <td width="50%">
                            <p>
                                Cedula: <b>{{ number_format($alumno->encargado1->cedula, 0, ".", ".") }}</b>
                            </p>
                            <p>
                                Nombre: <b>{{ $alumno->encargado1->nombre }}</b>
                            </p>
                            <p>
                                Parentezco: <b>{{ $alumno->encargado1->parentezco }}</b>
                            </p>
                            <p>
                                Telefono: <b>{{ $alumno->encargado1->telefono  }}</b>
                            </p>
                            <p>
                                Observación: <b>{{ $alumno->encargado1->observacion  }}</b>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;font-size: 13px;font-weight: bold">Encargado 3</td>
                        <td style="text-align: center; font-size: 13px;font-weight: bold">Encargado 4</td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                Cedula: <b>{{ number_format($alumno->encargado2->cedula, 0, ".", ".") }}</b>
                            </p>
                            <p>
                                Nombre: <b>{{ $alumno->encargado2->nombre }}</b> <b>{{ $alumno->encargado2->apellido }}</b>
                            </p>
                            <p>
                                Parentezco: <b>{{ $alumno->encargado2->parentezco }}</b>
                            </p>
                            <p>
                                Telefono: <b>{{ $alumno->encargado2->telefono  }}</b>
                            </p>
                            <p>
                                Observación: <b>{{ $alumno->encargado2->observacion  }}</b>
                            </p>
                        </td>
                        <td>
                            <p>
                                Cedula: <b>{{ number_format($alumno->encargado3->cedula, 0, ".", ".") }}</b>
                            </p>
                            <p>
                                Nombre: <b>{{ $alumno->encargado3->nombre }}</b> <b>{{ $alumno->encargado3->apellido }}</b>
                            </p>
                            <p>
                                Parentezco: <b>{{ $alumno->encargado3->parentezco }}</b>
                            </p>
                            <p>
                                Telefono: <b>{{ $alumno->encargado3->telefono  }}</b>
                            </p>
                            <p>
                                Observación: <b>{{ $alumno->encargado3->observacion  }}</b>
                            </p>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

        <div>
            <table class="content">
                <thead>
                    <tr>
                        <th>Documentos Presentados</th>
                    </tr>
                </thead>
                <tbody>
                    <td>
                        @foreach ($alumno->documentos as $item)
                            <p>X - {{ $item->concepto->nombre }}</p>
                        @endforeach
                    </td>
                </tbody>
            </table>
        </div>

        <div style="page-break-before: always;"></div>

        <div style="margin-bottom: 15px">
            <h4>Imagenes</h4>
        </div>

        @foreach ($alumno->documentos as $item)
            <div style="width: 100%">
                <div class="gallery">
                    <img alt="" class="card-img"
                    src="{{ asset(Storage::url($item->imagen))}}">
                    <div class="container">
                        <p>{{$item->concepto->nombre}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </body>

</html>
