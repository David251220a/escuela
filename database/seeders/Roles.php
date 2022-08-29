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
        $permission = Permission::create(['name' => 'alumno.index', 'descripcion' => 'Alumno Ver Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.create', 'descripcion' => 'Alumno Crear'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.edit', 'descripcion' => 'Alumno Editar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.show', 'descripcion' => 'Alumno Ver Ficha'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.update', 'descripcion' => 'Alumno Actualizar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.store', 'descripcion' => 'Alumno Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alumno.delete', 'descripcion' => 'Alumno Elimnar'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'matricula.index', 'descripcion' => 'Matricula Ver Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.create', 'descripcion' => 'Matricula Crear'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.edit', 'descripcion' => 'Matricula Editar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.show', 'descripcion' => 'Matricula Cuota Cobro -Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.update', 'descripcion' => 'Matricula Actualizar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.store', 'descripcion' => 'Matricula Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'matricula.delete', 'descripcion' => 'Matricula Elimnar'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'consulta.index', 'descripcion' => 'Consulta de Alumno por Grado/Turno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.cobros_varios', 'descripcion' => 'Consulta Ingresos Varios por Concepto/Fecha'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.cobros_varios_alumno', 'descripcion' => 'Consulta Ingresos del Alumno por Concepto/Fecha'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.cobros_varios_grado', 'descripcion' => 'Consulta Ingresos por Grado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.cobros_cuota', 'descripcion' => 'Consulta Cobro de Cuota'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.cobros_cuota_ver', 'descripcion' => 'Consulta Cobro de Cuota - Alumno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.grado_consulta', 'descripcion' => 'Consulta Cobro de Cuota - Grado/Mes'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.alumno_cuota_meses', 'descripcion' => 'Consulta Cobro de Cuota - Grado/Meses'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta.ver_alumno_cuota_meses', 'descripcion' => 'Consulta Cobro de Cuota - Alumno/Meses'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'ingreso.cobro', 'descripcion' => 'Ingreso Varios Crear'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ingreso.store', 'descripcion' => 'Ingreso Varios Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ingreso.nuevo_ingreso', 'descripcion' => 'Ingreso Vario Nuevo Concepto'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes', 'descripcion' => 'Ingreso Vario: Pendiente - Alumno']);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes_detalle', 'descripcion' => 'Ingreso Vario: Pendiente - Alumno/Detalle'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes_detalle_store', 'descripcion' => 'Ingreso Vario: Pendiente - Alumno/Detalle/Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes_detalle_imprimir', 'descripcion' => 'Ingreso Vario: Pendiente - Ver Ticked'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'madre_consulta', 'descripcion' => 'Modal: Consultar Madre'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'madre_crear', 'descripcion' => 'Modal: Crear Madre'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'padre_consulta', 'descripcion' => 'Modal: Consultar Padre'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'padre_crear', 'descripcion' => 'Modal: Crear Padre'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'encargado_consulta', 'descripcion' => 'Modal: Consulta Encargado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'encargado_crear', 'descripcion' => 'Modal: Crear Encargado'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'crear_datos', 'descripcion' => 'Modal: Crear Lugar Nacimiento/Alergia/Enfermedad/Seguro'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'matricula.buscar_alumno', 'descripcion' => 'Matricula: Buscar Alumno'])->syncRoles($admin);

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

        $permission = Permission::create(['name' => 'alergia.index', 'descripcion' => 'Alergia Ver Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alergia.create', 'descripcion' => 'Alergia Crear'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alergia.edit', 'descripcion' => 'Alergia Editar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alergia.show', 'descripcion' => 'Alergia Ver'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alergia.update', 'descripcion' => 'Alergia Actualizar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alergia.store', 'descripcion' => 'Alergia Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'alergia.delete', 'descripcion' => 'Alergia Elimnar'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'lugarnacimiento.index', 'descripcion' => 'Lugar de Nacimiento Ver Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'lugarnacimiento.create', 'descripcion' => 'Lugar de Nacimiento Crear'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'lugarnacimiento.edit', 'descripcion' => 'Lugar de Nacimiento Editar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'lugarnacimiento.show', 'descripcion' => 'Lugar de Nacimiento Ver'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'lugarnacimiento.update', 'descripcion' => 'Lugar de Nacimientogia Actualizar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'lugarnacimiento.store', 'descripcion' => 'Lugar de Nacimiento Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'lugarnacimiento.delete', 'descripcion' => 'Lugar de Nacimiento Elimnar'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'seguro.index', 'descripcion' => 'Seguro Ver Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'seguro.create', 'descripcion' => 'Seguro Crear'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'seguro.edit', 'descripcion' => 'Seguro Editar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'seguro.show', 'descripcion' => 'Seguro Ver'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'seguro.update', 'descripcion' => 'Seguro Actualizar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'seguro.store', 'descripcion' => 'Seguro Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'seguro.delete', 'descripcion' => 'Seguro Elimnar'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'enfermedad.index', 'descripcion' => 'Enfermedad Ver Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'enfermedad.create', 'descripcion' => 'Enfermedad Crear'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'enfermedad.edit', 'descripcion' => 'Enfermedad Editar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'enfermedad.show', 'descripcion' => 'Seguro Ver'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'enfermedad.update', 'descripcion' => 'Seguro Actualizar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'enfermedad.store', 'descripcion' => 'Seguro Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'enfermedad.delete', 'descripcion' => 'Seguro Elimnar'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'rol.index', 'descripcion' => 'Rol Ver Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'rol.create', 'descripcion' => 'Rol Crear'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'rol.edit', 'descripcion' => 'Rol Editar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'rol.show', 'descripcion' => 'Rol Ver'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'rol.update', 'descripcion' => 'Rol Actualizar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'rol.store', 'descripcion' => 'Rol Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'rol.delete', 'descripcion' => 'Rol Elimnar'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'usuario.index', 'descripcion' => 'Usuario Ver Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'usuario.create', 'descripcion' => 'Usuario Crear'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'usuario.edit', 'descripcion' => 'Usuario Editar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'usuario.show', 'descripcion' => 'Usuario Ver'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'usuario.update', 'descripcion' => 'Usuario Actualizar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'usuario.store', 'descripcion' => 'Usuario Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'usuario.delete', 'descripcion' => 'Usuario Elimnar'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'resetear_pass', 'descripcion' => 'Resetear Contraseña'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'consulta', 'descripcion' => 'Opciones Multiple: Ver Consulta'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'tablasecundaria', 'descripcion' => 'Opciones Multiple: Ver Tabla Secundaria'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'nacionalidad.index', 'descripcion' => 'Nacionalidad Ver Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'nacionalidad.create', 'descripcion' => 'Nacionalidad Crear'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'nacionalidad.edit', 'descripcion' => 'Nacionalidad Editar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'nacionalidad.show', 'descripcion' => 'Nacionalidad Ver'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'nacionalidad.update', 'descripcion' => 'Nacionalidad Actualizar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'nacionalidad.store', 'descripcion' => 'Nacionalidad Guardar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'nacionalidad.delete', 'descripcion' => 'Nacionalidad Elimnar'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'anulacion.index', 'descripcion' => 'Anulacion Ver Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'anulacion.show', 'descripcion' => 'Anulacion Ver Detalles-Alumno'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'anulacion.delete', 'descripcion' => 'Anulacion: Anular Cobro'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'parametro_general.index', 'descripcion' => 'Paramentro General: Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'parametro_general.store', 'descripcion' => 'Paramentro General: Actualizar'])->syncRoles($admin);

        $permission = Permission::create(['name' => 'ciclo.index', 'descripcion' => 'Ciclo: Listado'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ciclo.create', 'descripcion' => 'Ciclo: Crear'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ciclo.edit', 'descripcion' => 'Ciclo: Editar'])->syncRoles($admin);
        $permission = Permission::create(['name' => 'ciclo.update', 'descripcion' => 'Ciclo: Actualizar'])->syncRoles($admin);

    }
}
