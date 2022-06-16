<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Turno extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('turno')->insert([
            'nombre' => 'SIN ESPECIFICAR',
            'estado_id' => 1,
        ]);

        DB::table('turno')->insert([
            'nombre' => 'MAÑANA',
            'estado_id' => 1,
        ]);

        DB::table('turno')->insert([
            'nombre' => 'TARDE',
            'estado_id' => 1,
        ]);
    }
}
