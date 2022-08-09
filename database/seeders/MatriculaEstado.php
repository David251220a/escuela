<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatriculaEstado extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matricula_estado')->insert([
            'nombre' => 'PENDIENTE',
        ]);

        DB::table('matricula_estado')->insert([
            'nombre' => 'CANCELADO CON EXITO',
        ]);

        DB::table('matricula_estado')->insert([
            'nombre' => 'ANULADO',
        ]);
    }
}
