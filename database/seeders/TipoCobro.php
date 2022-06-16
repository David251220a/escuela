<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCobro extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_cobro')->insert([
            'nombre' => 'EFECTIVO',
            'usuario_alta' => 1,
            'estado_id' => 1,
        ]);

        DB::table('tipo_cobro')->insert([
            'nombre' => 'TRANSFERENCIA',
            'usuario_alta' => 1,
            'estado_id' => 1,
        ]);

        DB::table('tipo_cobro')->insert([
            'nombre' => 'EXONERACION',
            'usuario_alta' => 1,
            'estado_id' => 1,
        ]);
    }
}
