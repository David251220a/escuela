<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CobroController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LimpiarController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\AlergiaController;
use App\Http\Controllers\AnulacionController;
use App\Http\Controllers\LugarnacimientoController;
use App\Http\Controllers\SeguroController;
use App\Http\Controllers\EnfermedadController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\GrupoUsuarioController;
use App\Http\Controllers\PadresController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/limpiar', [LimpiarController::class, 'limpiar'])->name('limpiar');
Route::get('/link', function () {
    $target = '/home/kb57mc21mbm4/prestamosdev/storage/app/public';
    $shortcut = '/home/kb57mc21mbm4/prestamosdev/public/storage';
    symlink($target, $shortcut);
});

Route::get('/inicio', [DashboardController::class, 'index'])->name('inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [InicioController::class, 'index'])->name('dashboard');
    Route::get('/matriculas/cobros/{id}', [MatriculaController::class, 'cobros'])->name('matricula.cobro');
    Route::resource('/alumnos', AlumnoController::class)->names('alumno');
    Route::resource('/matriculas', MatriculaController::class)->names('matricula');

    Route::get('/consultas', [ConsultaController::class, 'index'])->name('consulta.index');
    Route::get('/consultas/cobros_varios', [ConsultaController::class, 'cobros_varios'])->name('consulta.cobros_varios');
    Route::get('/consultas/cobros_varios/alumno', [ConsultaController::class, 'cobros_varios_alumno'])->name('consulta.cobros_varios_alumno');
    Route::get('/consultas/cobros_varios/grado', [ConsultaController::class, 'cobros_varios_grado'])->name('consulta.cobros_varios_grado');
    Route::get('/consultas/cobros_cuota', [ConsultaController::class, 'cobros_cuota'])->name('consulta.cobros_cuota');
    Route::get('/consultas/cobros_cuota/{id}', [ConsultaController::class, 'cobros_cuota_ver'])->name('consulta.cobros_cuota_ver');
    Route::get('/consultas/grado_cuota', [ConsultaController::class, 'grado_consulta'])->name('consulta.grado_consulta');
    Route::get('/consultas/alumno_cuota_meses', [ConsultaController::class, 'alumno_cuota_meses'])->name('consulta.alumno_cuota_meses');
    Route::get('/consultas/alumno_cuota_meses/{alumno}', [ConsultaController::class, 'ver_alumno_cuota_meses'])->name('consulta.ver_alumno_cuota_meses');

    Route::get('/cobros/ingreso/{id}', [CobroController::class, 'cobros_varios'])->name('ingreso.cobro');
    Route::post('/cobros/ingreso/{id}', [CobroController::class, 'store'])->name('ingreso.store');
    Route::post('/crear_ingreso', [CobroController::class, 'nuevo_ingreso'])->name('ingreso.nuevo_ingreso');
    Route::get('/cobros/ingreso_pendiente/{id}', [CobroController::class, 'cobros_pendientes'])->name('ingreso.cobros_pendientes');
    Route::get('/cobros/ingreso_pendiente/{id}/cobro/{id2}', [CobroController::class, 'cobros_pendientes_detalle'])->name('ingreso.cobros_pendientes_detalle');
    Route::post('/cobros/ingreso_pendiente/{id}/cobro/{id2}', [CobroController::class, 'cobros_pendientes_detalle_store'])->name('ingreso.cobros_pendientes_detalle_store');
    Route::get('/cobros/ingreso_pendiente/{id}/cobro/{id2}/imprimir', [CobroController::class, 'cobros_pendientes_detalle_imprimir'])->name('ingreso.cobros_pendientes_detalle_imprimir');

    Route::post('/madre_consulta', [AlumnoController::class, 'madre_consulta'])->name('madre_consulta');
    Route::post('/madre_crear', [AlumnoController::class, 'madre_crear'])->name('madre_crear');
    Route::post('/padre_consulta', [AlumnoController::class, 'padre_consulta'])->name('padre_consulta');
    Route::post('/padre_crear', [AlumnoController::class, 'padre_crear'])->name('padre_crear');
    Route::post('/encargado_consulta', [AlumnoController::class, 'encargado_consulta'])->name('encargado_consulta');
    Route::post('/encargado_crear', [AlumnoController::class, 'encargado_crear'])->name('encargado_crear');
    Route::post('/crear_datos', [AlumnoController::class, 'crear_datos'])->name('crear_datos');
    Route::post('/editar_padres', [PadresController::class, 'editar_padres'])->name('editar_padre');
    Route::post('/editar_encargados', [PadresController::class, 'editar_encargado'])->name('editar_encargado');
    Route::post('/buscar_alumno', [MatriculaController::class, 'buscar_alumno'])->name('matricula.buscar_alumno');
    Route::get('/consulta/grado/{search_grado}/turno/{search_turno}/{ciclo}', [PDFController::class, 'alumno_grado_turno'])->name('pdf.alumno_grado_turno');
    Route::get('/matricula/comprobante/{id}', [PDFController::class, 'imprimir_cobro_cuota'])->name('imprimir_cobro_cuota');
    Route::get('/ingreso/cobros_grado', [PDFController::class, 'ingreso_grado_turno'])->name('pdf.ingreso_grado_turno');
    Route::get('/ingreso/alumnos_cobros', [PDFController::class, 'ingreso_alumno'])->name('pdf.ingreso_alumno');
    Route::get('/matricula/comprobante_matricula/{id}', [PDFController::class, 'imprimir_cobro_matricula'])->name('pdf.imprimir_cobro_matricula');
    Route::get('/ingreso/varios', [PDFController::class, 'ingreso_varios'])->name('pdf.ingreso_varios');
    Route::get('/ingreso/cuota', [PDFController::class, 'ingreso_cuota'])->name('pdf.ingreso_cuota');
    Route::get('/ingreso/matricula', [PDFController::class, 'ingreso_matricula'])->name('pdf.ingreso_matricula');
    Route::get('/ingreso/estado_cuenta/{id}', [PDFController::class, 'estado_cuenta'])->name('pdf.estado_cuenta');
    Route::get('/ingreso/cuota/mes', [PDFController::class, 'cuota_mes'])->name('pdf.cuota_mes');
    Route::get('/ingreso/recibo_varios/{id}/{id2}', [PDFController::class, 'recibo_varios'])->name('pdf.recibo_varios');
    Route::get('/pdf/alumno_cuota_meses/grado/{grado}/turno/{turno}', [PDFController::class, 'grado_cuota_meses'])->name('pdf.grado_cuota_meses');
    Route::get('/pdf/alumno_cuota_meses/alumno/{alumno}', [PDFController::class, 'alumno_cuota_meses'])->name('pdf.alumno_cuota_meses');
    Route::get('/pdf/alumno/ficha/{alumno}', [PDFController::class, 'ficha'])->name('pdf.ficha');

    Route::get('/anulaciones', [AnulacionController::class, 'index'])->name('anulacion.index');

    //Tablas Secundarias
    // Route::get('/secundaria/alergia', [AlergiaController::class, 'index'])->name('alergia.index');
    // Route::get('/secundaria/alergia/{alergia}', [AlergiaController::class, 'edit'])->name('alergia.edit');
    // Route::put('/secundaria/alergia/{alergia}', [AlergiaController::class, 'update'])->name('alergia.update');
    // Route::get('/secundaria/alergia/create', [AlergiaController::class, 'create'])->name('alergia.create');
    // Route::post('/secundaria/alergia', [AlergiaController::class, 'store'])->name('alergia.store');
    Route::resource('/grupo_usuario', GrupoUsuarioController::class, ['parameters' => [
    'grupo_usuario' => 'rol' ]])->names('rol');

    Route::resource('/usuarios', UsuarioController::class)->names('usuario');
    Route::get('/account', [UsuarioController::class, 'resetear_pass'])->name('resetear_pass');

    Route::resource('/alergias', AlergiaController::class)->names('alergia');
    Route::resource('/lugarnacimiento', LugarNacimientoController::class)->names('lugarnacimiento');
    Route::resource('/seguro', SeguroController::class)->names('seguro');
    Route::resource('/enfermedad', EnfermedadController::class)->names('enfermedad');

    Route::resource('/pais', PaisController::class, ['parameters' => [
        'pai' => 'pais' ]])->names('pais');
});
