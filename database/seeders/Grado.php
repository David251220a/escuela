<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Grado extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grado')->insert([
            'nombre' => 'SIN ESPECIFICAR',
            'estado_id' => 1,
        ]);
        DB::table('grado')->insert([
            'nombre' => 'MATERNAL 1',
            'estado_id' => 1,
        ]);

        DB::table('grado')->insert([
            'nombre' => 'MATERNAL 2',
            'estado_id' => 1,
        ]);

        DB::table('grado')->insert([
            'nombre' => 'PRE- JARDIN',
            'estado_id' => 1,
        ]);

        DB::table('grado')->insert([
            'nombre' => 'JARDIN',
            'estado_id' => 1,
        ]);

        DB::table('grado')->insert([
            'nombre' => 'PRE - ESCOLAR',
            'estado_id' => 1,
        ]);
        DB::table('grado')->insert([
            'nombre' => 'PRIMER GRADO',
            'estado_id' => 1,
        ]);

        DB::table('grado')->insert([
            'nombre' => 'SEGUNDO GRADO',
            'estado_id' => 1,
        ]);
        DB::table('grado')->insert([
            'nombre' => 'TERCER GRADO',
            'estado_id' => 1,
        ]);
        DB::table('grado')->insert([
            'nombre' => 'CUARTO GRADO',
            'estado_id' => 1,
        ]);
        DB::table('grado')->insert([
            'nombre' => 'QUINTO GRADO',
            'estado_id' => 1,
        ]);
        DB::table('grado')->insert([
            'nombre' => 'SEXTO GRADO',
            'estado_id' => 1,
        ]);
    }
}
