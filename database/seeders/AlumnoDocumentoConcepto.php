<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnoDocumentoConcepto extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alumno_documento_concepto')->insert([
            'nombre' => 'FOTO CARNET',
            'estado_id' => 1,
            'usuario_grabacion' => 1,
            'usuario_modificacion' => 1,
            'orden' => 1,
        ]);

        DB::table('alumno_documento_concepto')->insert([
            'nombre' => 'CERTIFICADO DE NACIMIENTO-ORIGINAL',
            'estado_id' => 1,
            'usuario_grabacion' => 1,
            'usuario_modificacion' => 1,
            'orden' => 2,
        ]);

        DB::table('alumno_documento_concepto')->insert([
            'nombre' => 'FOTOCOPIA DE CEDULA',
            'estado_id' => 1,
            'usuario_grabacion' => 1,
            'usuario_modificacion' => 1,
            'orden' => 3,
        ]);

        DB::table('alumno_documento_concepto')->insert([
            'nombre' => 'FOTOCOPIA DE CEDULA - PADRE',
            'estado_id' => 1,
            'usuario_grabacion' => 1,
            'usuario_modificacion' => 1,
            'orden' => 4,
        ]);

        DB::table('alumno_documento_concepto')->insert([
            'nombre' => 'FOTOCOPIA DE CEDULA - MADRE',
            'estado_id' => 1,
            'usuario_grabacion' => 1,
            'usuario_modificacion' => 1,
            'orden' => 5,
        ]);

        DB::table('alumno_documento_concepto')->insert([
            'nombre' => 'CERTIFICADO DE NACIMIENTO - FOTOCOPIA',
            'estado_id' => 1,
            'usuario_grabacion' => 1,
            'usuario_modificacion' => 1,
            'orden' => 6,
        ]);

        DB::table('alumno_documento_concepto')->insert([
            'nombre' => 'CERTIFICADO DE VACUNACION',
            'estado_id' => 1,
            'usuario_grabacion' => 1,
            'usuario_modificacion' => 1,
            'orden' => 7,
        ]);
    }

}
