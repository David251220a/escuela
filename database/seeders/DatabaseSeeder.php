<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('users')->insert([
        //     'name' => 'Usuario',
        //     'email' => 'dev@dev',
        //     'password' => Hash::make('hola123456'),
        // ]);

        // $this->call([
        //     Estado::class,
        // ]);

        DB::table('tipo_documento')->insert([
            'nombre' => 'DOCUMENTO DE IDENTIDAD',
            'estado_id' => 1,
            'usuario_grabacion' => 1,
        ]);

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
            'nombre' => 'CAUARTO GRADO',
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
