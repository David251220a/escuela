<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Padre extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('padre')->insert([
            'nombre' => 'SIN ESPECIFICAR',
            'apellido' => 'SIN ESPECIFICAR',
            'cedula' => 0,
            'direccion' => 'SIN ESPECIFICAR',
            'usuario_grabacion' => 1,
            'usuario_modificacion' => 1,
            'estado_id' => 1,
            'tipo_documento_id' => 1,
        ]);
    }
}
