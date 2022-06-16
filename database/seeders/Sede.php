<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Sede extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sede')->insert([
            'nombre' => 'SEDE CENTRAL',
            'direccion' => ' ',
            'telefono' => ' ',
            'fax' => ' ',
            'correo' => ' ',
            'usuario_alta' => 1,
            'usuario_modificacion' => 1,
            'estado_id' => 1,
        ]);
    }
}
