<?php

namespace Database\Seeders;

use App\Models\CobroIngreso;
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

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@dev',
            'password' => Hash::make('admin123456'),
        ]);

        DB::table('paramentro_general')->insert([
            'monto_multa' => 0,
            'cantidad_dias_gracia' => 0
        ]);

        $this->call([
            Estado::class,
            TipoDocumento::class,
            Turno::class,
            Grado::class,
            Sede::class,
            Ciclo::class,
            CobroConcepto::class,
            Madre::class,
            Padre::class,
            Encargado::class,
            TipoCobro::class,
            MatriculaEstado::class,
            AlumnoDocumentoConcepto::class,
            Alergia::class,
            Seguro::class,
            IngregoConcepto::class,
            Ingreso_Estado::class,
            Enfermedad::class,
        ]);

    }
}
