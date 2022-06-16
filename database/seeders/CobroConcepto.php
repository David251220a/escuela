<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CobroConcepto extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cobro_concepto')->insert([
            'nombre' => 'COBRO MATRICULA',
            'usuario_alta' => 1,
            'usuario_modificacion' => 1,
            'estado_id' => 1,
        ]);
        DB::table('cobro_concepto')->insert([
            'nombre' => 'COBRO CUOTA',
            'estado_id' => 1,
            'usuario_alta' => 1,
            'usuario_modificacion' => 1,
        ]);
        DB::table('cobro_concepto')->insert([
            'nombre' => 'INGRESO',
            'estado_id' => 1,
            'usuario_alta' => 1,
            'usuario_modificacion' => 1,
        ]);
    }
}
