<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Ciclo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ciclo')->insert([
            'nombre' => '2021',
            'sede_id' => 1,
            'meses' => 10,
            'año' => 2021,
            'fecha_inicio' => '2021-02-02',
            'fecha_fin' => '2021-11-30',
            'usuario_alta' => 1,
            'estado_id' => 2,
        ]);

        DB::table('ciclo')->insert([
            'nombre' => '2022',
            'sede_id' => 1,
            'meses' => 10,
            'año' => 2022,
            'fecha_inicio' => '2022-02-02',
            'fecha_fin' => '2022-11-30',
            'usuario_alta' => 1,
            'estado_id' => 1,
        ]);
    }
}
