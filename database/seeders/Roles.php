<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);

        $permission = Permission::create(['name' => 'matricula.cobro', 'descripcion' => 'Matricula Cuota Cobro - Alumno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.index', 'descripcion' => 'Ver Listado Alumno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.edit', 'descripcion' => 'Editar Alumno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.show', 'descripcion' => 'Ver Ficha Alumno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.update', 'descripcion' => 'Actualizar Alumno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.store', 'descripcion' => 'Guardar Alumno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.delete', 'descripcion' => 'Elimnar Alumno'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'matricula.index', 'descripcion' => 'Ver Listado de Matriculas'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.edit', 'descripcion' => 'Editar Matricula'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.show', 'descripcion' => 'Matricula Cuota Cobro'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.update', 'descripcion' => 'Actualizar Matricula'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.store', 'descripcion' => 'Guardar Matricula'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.delete', 'descripcion' => 'Elimnar Matricula'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'consulta.index', 'descripcion' => 'Consulta de Alumno por Grado/Turno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.cobros_varios', 'descripcion' => 'Consulta Ingresos Varios por Concepto/Fecha'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.cobros_varios_alumno', 'descripcion' => 'Consulta Ingresos del Alumno por Concepto/Fecha'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.cobros_varios_grado', 'descripcion' => 'Consulta Ingresos por Grado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.cobros_cuota', 'descripcion' => 'Consulta Cobro de Cuota'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.cobros_cuota_ver', 'descripcion' => 'Consulta Cobro de Cuota - Alumno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.grado_consulta', 'descripcion' => 'Consulta Cobro de Cuota - Grado/Mes'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.alumno_cuota_meses', 'descripcion' => 'Consulta Cobro de Cuota - Grado/Meses'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.ver_alumno_cuota_meses', 'descripcion' => 'Consulta Cobro de Cuota - Alumno/Meses'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'ingreso.cobro', 'descripcion' => 'Nuevo Ingreso Varios'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ingreso.store', 'descripcion' => 'Guardar Ingreso Varios'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ingreso.nuevo_ingreso', 'descripcion' => 'Nuevo Concepto de Ingresos Varios'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes', 'descripcion' => 'Ingresos Varios Pendiente - Alumno']);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes_detalle', 'descripcion' => 'Ingresos Varios Pendiente - Alumno/Detalle'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes_detalle_store', 'descripcion' => 'Ingresos Varios Pendiente - Alumno/Detalle/Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes_detalle_imprimir', 'descripcion' => 'Ingresos Varios Pendiente - Ver Ticked'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'madre_consulta', 'descripcion' => 'Consultar Madre - Modal'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'madre_crear', 'descripcion' => 'Crear Madre - Modal'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'padre_consulta', 'descripcion' => 'Consultar Padre - Modal'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'padre_crear', 'descripcion' => 'Crear Padre - Modal'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'encargado_consulta', 'descripcion' => 'Consulta Encargado - Modal'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'encargado_crear', 'descripcion' => 'Crear Encargado - Modal'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'crear_datos', 'descripcion' => 'Crear Lugar Nacimiento/Alergia/Enfermedad/Seguro - Modal'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.buscar_alumno', 'descripcion' => 'Buscar Alumno - Matricula'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.alumno_grado_turno', 'descripcion' => 'Ver PDF - Listado de Alumno Grado-Turno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'imprimir_cobro_cuota', 'descripcion' => 'Ver PDF - Ticked Cobro Cuota'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.ingreso_grado_turno', 'descripcion' => 'Ver PDF - Listado Ingresos Varios Grado-Turno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.ingreso_alumno', 'descripcion' => 'Ver PDF - Listado Ingresos Varios Alumno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.imprimir_cobro_matricula', 'descripcion' => 'Ver PDF - Ticked Cobro de Matricula'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.ingreso_varios', 'descripcion' => 'Ver PDF - Listado Ingresos Varios - Fecha'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.ingreso_cuota', 'descripcion' => 'Ver PDF - Listado Ingresos Varios - Cobro Cuota'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.ingreso_matricula', 'descripcion' => 'Ver PDF - Listado Ingresos Varios - Cobro Matricula'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.estado_cuenta', 'descripcion' => 'Ver PDF - Estado de Cuenta'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.cuota_mes', 'descripcion' => 'Ver PDF - Cobro Cuota - Mes/Grado/Turno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.recibo_varios', 'descripcion' => 'Ver PDF - Ticked Ingresos Varios'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.grado_cuota_meses', 'descripcion' => 'Ver PDF - Cuotas Meses Pagados - Grado/Turno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.alumno_cuota_meses', 'descripcion' => 'Ver PDF - Cuotas Meses Pagados - Alumno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'pdf.ficha', 'descripcion' => 'Ver PDF - Ficha Alumno'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'alergia.index', 'descripcion' => 'Ver Listado de Alergia'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alergia.edit', 'descripcion' => 'Editar Alergia'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alergia.show', 'descripcion' => 'Ver Alergia'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alergia.update', 'descripcion' => 'Actualizar Alergia'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alergia.store', 'descripcion' => 'Guardar Alergia'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alergia.delete', 'descripcion' => 'Elimnar Alergia'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'lugarnacimiento.index', 'descripcion' => 'Ver Listado de Lugar de Nacimiento'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'lugarnacimiento.edit', 'descripcion' => 'Editar Lugar de Nacimiento'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'lugarnacimiento.show', 'descripcion' => 'Ver Lugar de Nacimiento'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'lugarnacimiento.update', 'descripcion' => 'Actualizar Lugar de Nacimientogia'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'lugarnacimiento.store', 'descripcion' => 'Guardar Lugar de Nacimiento'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'lugarnacimiento.delete', 'descripcion' => 'Elimnar Lugar de Nacimiento'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'seguro.index', 'descripcion' => 'Ver Listado de Seguro'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'seguro.edit', 'descripcion' => 'Editar Seguro'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'seguro.show', 'descripcion' => 'Ver Seguro'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'seguro.update', 'descripcion' => 'Actualizar Seguro'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'seguro.store', 'descripcion' => 'Guardar Seguro'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'seguro.delete', 'descripcion' => 'Elimnar Seguro'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'enfermedad.index', 'descripcion' => 'Ver Listado de Seguro'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'enfermedad.edit', 'descripcion' => 'Editar Enfermedad'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'enfermedad.show', 'descripcion' => 'Ver Seguro'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'enfermedad.update', 'descripcion' => 'Actualizar Seguro'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'enfermedad.store', 'descripcion' => 'Guardar Seguro'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'enfermedad.delete', 'descripcion' => 'Elimnar Seguro'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'rol.index', 'descripcion' => 'Ver Listado Roles'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'rol.edit', 'descripcion' => 'Editar Rol'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'rol.show', 'descripcion' => 'Ver Rol'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'rol.update', 'descripcion' => 'Actualizar Rol'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'rol.store', 'descripcion' => 'Guardar Rol'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'rol.delete', 'descripcion' => 'Elimnar Rol'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'usuario.index', 'descripcion' => 'Ver Listado de Usuario'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'usuario.edit', 'descripcion' => 'Editar Usuario'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'usuario.show', 'descripcion' => 'Ver Usuario'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'usuario.update', 'descripcion' => 'Actualizar Usuario'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'usuario.store', 'descripcion' => 'Guardar Usuario'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'usuario.delete', 'descripcion' => 'Elimnar Usuario'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'resetear_pass', 'descripcion' => 'Resetear Contraseña'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta', 'descripcion' => 'Ver Consulta'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'tablasecundaria', 'descripcion' => 'Ver Tabla Secundaria'])->syncRoles($admin);

    }
}
