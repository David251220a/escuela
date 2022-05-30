<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\InicioController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [InicioController::class, 'index'])->name('dashboard');
    Route::resource('/alumnos', AlumnoController::class)->names('alumno');
    Route::post('/madre_consulta', [AlumnoController::class, 'madre_consulta'])->name('madre_consulta');
    Route::post('/madre_crear', [AlumnoController::class, 'madre_crear'])->name('madre_crear');
    Route::post('/padre_consulta', [AlumnoController::class, 'padre_consulta'])->name('padre_consulta');
    Route::post('/padre_crear', [AlumnoController::class, 'padre_crear'])->name('padre_crear');
    Route::post('/encargado_consulta', [AlumnoController::class, 'encargado_consulta'])->name('encargado_consulta');
    Route::post('/encargado_crear', [AlumnoController::class, 'encargado_crear'])->name('encargado_crear');
});
