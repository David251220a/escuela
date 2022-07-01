<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class Permisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::create(['name' => 'matricula.cobro', 'descripcion' => 'Cobro de Matricula']);
        $permission = Permission::create(['name' => 'alumno.index', 'descripcion' => 'Ver Listado Alumno']);
        $permission = Permission::create(['name' => 'alumno.edit', 'descripcion' => 'Editar Alumno']);
        $permission = Permission::create(['name' => 'alumno.show', 'descripcion' => 'Ver Ficha Alumno']);
        $permission = Permission::create(['name' => 'alumno.update', 'descripcion' => 'Actualizar Alumno']);
        $permission = Permission::create(['name' => 'alumno.store', 'descripcion' => 'Guardar Alumno']);
        $permission = Permission::create(['name' => 'alumno.delete', 'descripcion' => 'Elimnar Alumno']);

        $permission = Permission::create(['name' => 'matricula.index', 'descripcion' => 'Ver Listado de Matriculas']);
        $permission = Permission::create(['name' => 'matricula.edit', 'descripcion' => 'Editar Matricula']);
        $permission = Permission::create(['name' => 'matricula.show', 'descripcion' => 'Estado de Cuenta Matricula']);
        $permission = Permission::create(['name' => 'matricula.update', 'descripcion' => 'Actualizar Matricula']);
        $permission = Permission::create(['name' => 'matricula.store', 'descripcion' => 'Guardar Matricula']);
        $permission = Permission::create(['name' => 'matricula.delete', 'descripcion' => 'Elimnar Matricula']);

        $permission = Permission::create(['name' => 'consulta.index', 'descripcion' => 'Consulta de Alumno por Grado/Turno']);
        $permission = Permission::create(['name' => 'consulta.cobros_varios', 'descripcion' => 'Consulta Ingresos Varios por Concepto/Fecha']);
        $permission = Permission::create(['name' => 'consulta.cobros_varios_alumno', 'descripcion' => 'Consulta Ingresos del Alumno por Concepto/Fecha']);
        $permission = Permission::create(['name' => 'consulta.cobros_varios_grado', 'descripcion' => 'Consulta Ingresos por Grado']);
        $permission = Permission::create(['name' => 'consulta.cobros_cuota', 'descripcion' => 'Consulta Cobro de Cuota']);
        $permission = Permission::create(['name' => 'consulta.cobros_cuota_ver', 'descripcion' => 'Consulta Cobro de Cuota - Alumno']);
        $permission = Permission::create(['name' => 'consulta.grado_consulta', 'descripcion' => 'Consulta Cobro de Cuota - Grado/Mes']);
        $permission = Permission::create(['name' => 'consulta.alumno_cuota_meses', 'descripcion' => 'Consulta Cobro de Cuota - Grado/Meses']);
        $permission = Permission::create(['name' => 'consulta.ver_alumno_cuota_meses', 'descripcion' => 'Consulta Cobro de Cuota - Alumno/Meses']);

        $permission = Permission::create(['name' => 'ingreso.cobro', 'descripcion' => 'Nuevo Ingreso Varios']);
        $permission = Permission::create(['name' => 'ingreso.store', 'descripcion' => 'Guardar Ingreso Varios']);
        $permission = Permission::create(['name' => 'ingreso.nuevo_ingreso', 'descripcion' => 'Nuevo Concepto de Ingresos Varios']);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes', 'descripcion' => 'Ingresos Varios Pendiente - Alumno']);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes_detalle', 'descripcion' => 'Ingresos Varios Pendiente - Alumno/Detalle']);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes_detalle_store', 'descripcion' => 'Ingresos Varios Pendiente - Alumno/Detalle/Guardar']);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes_detalle_imprimir', 'descripcion' => 'Ingresos Varios Pendiente - Ver Ticked']);
        $permission = Permission::create(['name' => 'ingreso.cobros_pendientes_detalle_imprimir', 'descripcion' => 'Ingresos Varios Pendiente - Ver Ticked']);

        $permission = Permission::create(['name' => 'madre_consulta', 'descripcion' => 'Consultar Madre - Modal']);
        $permission = Permission::create(['name' => 'madre_crear', 'descripcion' => 'Crear Madre - Modal']);

        $permission = Permission::create(['name' => 'padre_consulta', 'descripcion' => 'Consultar Padre - Modal']);
        $permission = Permission::create(['name' => 'padre_crear', 'descripcion' => 'Crear Padre - Modal']);

        $permission = Permission::create(['name' => 'encargado_consulta', 'descripcion' => 'Consulta Encargado - Modal']);
        $permission = Permission::create(['name' => 'encargado_crear', 'descripcion' => 'Crear Encargado - Modal']);

        $permission = Permission::create(['name' => 'crear_datos', 'descripcion' => 'Crear Lugar Nacimiento/Alergia/Enfermedad/Seguro - Modal']);
        $permission = Permission::create(['name' => 'matricula.buscar_alumno', 'descripcion' => 'Buscar Alumno - Matricula']);
        $permission = Permission::create(['name' => 'pdf.alumno_grado_turno', 'descripcion' => 'Ver PDF - Listado de Alumno Grado-Turno']);
        $permission = Permission::create(['name' => 'imprimir_cobro_cuota', 'descripcion' => 'Ver PDF - Ticked Cobro Cuota']);
        $permission = Permission::create(['name' => 'pdf.ingreso_grado_turno', 'descripcion' => 'Ver PDF - Listado Ingresos Varios Grado-Turno']);
        $permission = Permission::create(['name' => 'pdf.ingreso_alumno', 'descripcion' => 'Ver PDF - Listado Ingresos Varios Alumno']);
        $permission = Permission::create(['name' => 'pdf.imprimir_cobro_matricula', 'descripcion' => 'Ver PDF - Ticked Cobro de Matricula']);
        $permission = Permission::create(['name' => 'pdf.ingreso_varios', 'descripcion' => 'Ver PDF - Listado Ingresos Varios - Fecha']);
        $permission = Permission::create(['name' => 'pdf.ingreso_cuota', 'descripcion' => 'Ver PDF - Listado Ingresos Varios - Cobro Cuota']);
        $permission = Permission::create(['name' => 'pdf.ingreso_matricula', 'descripcion' => 'Ver PDF - Listado Ingresos Varios - Cobro Matricula']);
        $permission = Permission::create(['name' => 'pdf.estado_cuenta', 'descripcion' => 'Ver PDF - Estado de Cuenta']);
        $permission = Permission::create(['name' => 'pdf.cuota_mes', 'descripcion' => 'Ver PDF - Cobro Cuota - Mes/Grado/Turno']);
        $permission = Permission::create(['name' => 'pdf.recibo_varios', 'descripcion' => 'Ver PDF - Ticked Ingresos Varios']);
        $permission = Permission::create(['name' => 'pdf.grado_cuota_meses', 'descripcion' => 'Ver PDF - Cuotas Meses Pagados - Grado/Turno']);
        $permission = Permission::create(['name' => 'pdf.alumno_cuota_meses', 'descripcion' => 'Ver PDF - Cuotas Meses Pagados - Alumno']);
        $permission = Permission::create(['name' => 'pdf.ficha', 'descripcion' => 'Ver PDF - Ficha Alumno']);

        $permission = Permission::create(['name' => 'alergia.index', 'descripcion' => 'Ver Listado de Alergia']);
        $permission = Permission::create(['name' => 'alergia.edit', 'descripcion' => 'Editar Alergia']);
        $permission = Permission::create(['name' => 'alergia.show', 'descripcion' => 'Ver Alergia']);
        $permission = Permission::create(['name' => 'alergia.update', 'descripcion' => 'Actualizar Alergia']);
        $permission = Permission::create(['name' => 'alergia.store', 'descripcion' => 'Guardar Alergia']);
        $permission = Permission::create(['name' => 'alergia.delete', 'descripcion' => 'Elimnar Alergia']);

        $permission = Permission::create(['name' => 'lugarnacimiento.index', 'descripcion' => 'Ver Listado de Lugar de Nacimiento']);
        $permission = Permission::create(['name' => 'lugarnacimiento.edit', 'descripcion' => 'Editar Lugar de Nacimiento']);
        $permission = Permission::create(['name' => 'lugarnacimiento.show', 'descripcion' => 'Ver Lugar de Nacimiento']);
        $permission = Permission::create(['name' => 'lugarnacimiento.update', 'descripcion' => 'Actualizar Lugar de Nacimientogia']);
        $permission = Permission::create(['name' => 'lugarnacimiento.store', 'descripcion' => 'Guardar Lugar de Nacimiento']);
        $permission = Permission::create(['name' => 'lugarnacimiento.delete', 'descripcion' => 'Elimnar Lugar de Nacimiento']);

        $permission = Permission::create(['name' => 'seguro.index', 'descripcion' => 'Ver Listado de Seguro']);
        $permission = Permission::create(['name' => 'seguro.edit', 'descripcion' => 'Editar Seguro']);
        $permission = Permission::create(['name' => 'seguro.show', 'descripcion' => 'Ver Seguro']);
        $permission = Permission::create(['name' => 'seguro.update', 'descripcion' => 'Actualizar Seguro']);
        $permission = Permission::create(['name' => 'seguro.store', 'descripcion' => 'Guardar Seguro']);
        $permission = Permission::create(['name' => 'seguro.delete', 'descripcion' => 'Elimnar Seguro']);

        $permission = Permission::create(['name' => 'enfermedad.index', 'descripcion' => 'Ver Listado de Seguro']);
        $permission = Permission::create(['name' => 'enfermedad.edit', 'descripcion' => 'Editar Seguro']);
        $permission = Permission::create(['name' => 'enfermedad.show', 'descripcion' => 'Ver Seguro']);
        $permission = Permission::create(['name' => 'enfermedad.update', 'descripcion' => 'Actualizar Seguro']);
        $permission = Permission::create(['name' => 'enfermedad.store', 'descripcion' => 'Guardar Seguro']);
        $permission = Permission::create(['name' => 'enfermedad.delete', 'descripcion' => 'Elimnar Seguro']);

        $permission = Permission::create(['name' => 'nacionalidad.index', 'descripcion' => 'Ver Listado de Nacionalidad']);
        $permission = Permission::create(['name' => 'nacionalidad.edit', 'descripcion' => 'Editar Nacionalidad']);
        $permission = Permission::create(['name' => 'nacionalidad.show', 'descripcion' => 'Ver Nacionalidad']);
        $permission = Permission::create(['name' => 'nacionalidad.update', 'descripcion' => 'Actualizar Nacionalidad']);
        $permission = Permission::create(['name' => 'nacionalidad.store', 'descripcion' => 'Guardar Nacionalidad']);
        $permission = Permission::create(['name' => 'nacionalidad.delete', 'descripcion' => 'Elimnar Nacionalidad']);

    }
}
