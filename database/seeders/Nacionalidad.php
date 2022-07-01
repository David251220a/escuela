<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Nacionalidad extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nacionalidad')->insert([
            'nombre' => 'SIN ESPECIFICAR',
            'usuario_grabacion' => 1,
            'usuario_modificacion' => 1,
            'estado_id' => 1,
        ]);
    }
}
