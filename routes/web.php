<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LimpiarController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PDFController;
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

Route::get('/limpiar', [LimpiarController::class, 'index'])->name('limpiar');
Route::get('/link', function () {
    $target = '/home/kb57mc21mbm4/escuela/storage/app/public';
    $shortcut = '/home/kb57mc21mbm4/escuela/public/storage';
    symlink($target, $shortcut);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/cobros', [MatriculaController::class, 'cobros'])->name('cobros');
    Route::get('/', [InicioController::class, 'index'])->name('dashboard');
    Route::resource('/alumnos', AlumnoController::class)->names('alumno');
    Route::resource('/matriculas', MatriculaController::class)->names('matricula');

    Route::post('/madre_consulta', [AlumnoController::class, 'madre_consulta'])->name('madre_consulta');
    Route::post('/madre_crear', [AlumnoController::class, 'madre_crear'])->name('madre_crear');
    Route::post('/padre_consulta', [AlumnoController::class, 'padre_consulta'])->name('padre_consulta');
    Route::post('/padre_crear', [AlumnoController::class, 'padre_crear'])->name('padre_crear');
    Route::post('/encargado_consulta', [AlumnoController::class, 'encargado_consulta'])->name('encargado_consulta');
    Route::post('/encargado_crear', [AlumnoController::class, 'encargado_crear'])->name('encargado_crear');
    Route::post('/crear_datos', [AlumnoController::class, 'crear_datos'])->name('crear_datos');
    Route::post('/buscar_alumno', [MatriculaController::class, 'buscar_alumno'])->name('matricula.buscar_alumno');
    Route::get('/matricula/comprobante/{id}', [PDFController::class, 'imprimir_cobro_cuota'])->name('imprimir_cobro_cuota');

});
