<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Ingreso_Estado extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingreso_estado')->insert([
            'nombre' => 'PENDIENTE',
        ]);

        DB::table('ingreso_estado')->insert([
            'nombre' => 'CANCELADO',
        ]);
    }
}
