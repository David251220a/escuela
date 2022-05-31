<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado', function (Blueprint $table) {
            $table->unsignedInteger('id',true);
            $table->string('nombre', 30);
        });

        Schema::create('grado', function (Blueprint $table) {
            $table->integer('id',true);
            $table->string('nombre', 30);
            $table->unsignedInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('turno', function (Blueprint $table) {
            $table->integer('id',true);
            $table->string('nombre', 30);
            $table->unsignedInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('tipo_documento', function (Blueprint $table) {
            $table->integer('id',true);
            $table->string('nombre', 30);
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('alergia', function (Blueprint $table) {
            $table->integer('id',true);
            $table->string('nombre', 30);
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->integer('usuario_modificacion')->nullable();
            $table->timestamps();
            $table->foreign('estado_id')->references('id')->on('estado');

        });

        Schema::create('lugar_nacimiento', function (Blueprint $table) {
            $table->integer('id',true);
            $table->string('nombre', 30);
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->integer('usuario_modificacion')->nullable();
            $table->timestamps();
            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('seguro', function (Blueprint $table) {
            $table->integer('id',true);
            $table->string('nombre', 30);
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->integer('usuario_modificacion')->nullable();
            $table->timestamps();
            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('encargado', function (Blueprint $table) {
            $table->integer('id',true);
            $table->string('nombre', 100);
            $table->string('cedula', 10);
            $table->string('parentezco', 50)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->integer('usuario_modificacion')->nullable();
            $table->timestamps();
            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('madre', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('cedula', 10);
            $table->string('telefono_particular', 12)->nullable();
            $table->string('telefono_wapp', 12)->nullable();
            $table->string('lugar_trabajo', 150)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('horario_dias_trabajo', 150)->nullable();
            $table->string('telefono_laboral', 15)->nullable();
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->integer('usuario_modificacion')->nullable();
            $table->unsignedInteger('estado_id');
            $table->integer('tipo_documento_id');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');
        });

        Schema::create('padre', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('cedula', 10);
            $table->string('telefono_particular', 12)->nullable();
            $table->string('telefono_wapp', 12)->nullable();
            $table->string('lugar_trabajo', 150)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('horario_dias_trabajo', 150)->nullable();
            $table->string('telefono_laboral', 15)->nullable();
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->integer('usuario_modificacion')->nullable();
            $table->unsignedInteger('estado_id');
            $table->integer('tipo_documento_id');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');
        });

        Schema::create('alumno', function (Blueprint $table) {
            $table->unsignedInteger('id', true);
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->date('fecha_nacimiento');
            $table->char('edad', 2);
            $table->char('sexo', 2);
            $table->integer('madre_id')->default(0);
            $table->integer('padre_id')->default(0);
            $table->string('cedula', 10);
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->integer('usuario_modificacion')->nullable();
            $table->integer('lugar_nacimiento_id');
            $table->string('telefono_baja', 15)->nullable();
            $table->string('direccion', 200)->default(' ');
            $table->string('telefono', 15)->nullable();
            $table->integer('alergia_id')->default(0);
            $table->integer('seguro_id')->default(0);
            $table->char('cantidad_hermanos', 2)->default(0);
            $table->integer('encargado_id')->default(0);
            $table->unsignedInteger('estado_id')->default(1);;
            $table->boolean('foto_carnet')->default(false);
            $table->boolean('certificado_nacimiento')->default(false);
            $table->boolean('fotocopia_cedula')->default(false);
            $table->boolean('fotocopia_cedula_padres')->default(false);
            $table->boolean('certificado_nacimiento_copia')->default(false);
            $table->boolean('libreta_vacunacion')->default(false);
            $table->integer('encargado_id_1')->default(0);
            $table->integer('grado_id')->default(0);;
            $table->integer('turno_id')->default(0);;
            $table->integer('encargado_id_2')->default(0);
            $table->integer('encargado_id_3')->default(0);
            $table->string('foto', 255)->nullable();
            $table->timestamps();

            $table->foreign('madre_id')->references('id')->on('madre');
            $table->foreign('padre_id')->references('id')->on('padre');
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('lugar_nacimiento_id')->references('id')->on('lugar_nacimiento');
            $table->foreign('alergia_id')->references('id')->on('alergia');
            $table->foreign('seguro_id')->references('id')->on('seguro');
            $table->foreign('encargado_id')->references('id')->on('encargado');
            $table->foreign('encargado_id_2')->references('id')->on('encargado');
            $table->foreign('encargado_id_3')->references('id')->on('encargado');
            $table->foreign('grado_id')->references('id')->on('grado');
            $table->foreign('turno_id')->references('id')->on('turno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno');
        Schema::dropIfExists('madre');
        Schema::dropIfExists('padre');
        Schema::dropIfExists('alergia');
        Schema::dropIfExists('encargado');
        Schema::dropIfExists('lugar_nacimiento');
        Schema::dropIfExists('seguro');
        Schema::dropIfExists('tipo_documento');
        Schema::dropIfExists('estado');
    }
};
