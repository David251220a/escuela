<?php

namespace Database\Seeders;

use App\Models\CobroIngreso;
use App\Models\User;
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

        $this->call(Roles::class);

        User::create([
            'name' => 'Admin1',
            'email' => 'admin1@dev',
            'password' => Hash::make('admin123456'),
        ])->assignRole('admin');


        $this->call([
            // Estado::class,
            // TipoDocumento::class,
            // Turno::class,
            // Grado::class,
            // Sede::class,
            // Ciclo::class,
            // CobroConcepto::class,
            // Madre::class,
            // Padre::class,
            // Encargado::class,
            // TipoCobro::class,
            // MatriculaEstado::class,
            // AlumnoDocumentoConcepto::class,
            // Alergia::class,
            // Seguro::class,
            // IngregoConcepto::class,
            // Ingreso_Estado::class,
            // Enfermedad::class,
            Pais::class,
            Nacionalidad::class,
        ]);

        // DB::table('paramentro_general')->insert([
        //     'monto_multa' => 0,
        //     'cantidad_dias_gracia' => 0,
        //     'estado_id' => 1,
        //     'usuario_grabacion' => 1,
        //     'usuario_modificacion' => 1,
        // ]);

    }
}
