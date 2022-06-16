<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngregoConcepto extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cobro_ingreso_concepto')->insert([
            'nombre' => 'DERECHO DE EXAMEN - PRIMERA ETAPA',
            'estado_id' => 1,
            'precio' => 25000,
            'unico' => 1,
        ]);

        DB::table('cobro_ingreso_concepto')->insert([
            'nombre' => 'DERECHO DE EXAMEN - SEGUNDA ETAPA',
            'estado_id' => 1,
            'precio' => 25000,
            'unico' => 1,
        ]);
    }
}
