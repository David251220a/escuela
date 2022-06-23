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

        Schema::create('paramentro_general', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('monto_multa');
            $table->integer('cantidad_dias_gracia');
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('matricula_estado', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 50);
        });

        Schema::create('matricula', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedInteger('alumno_id');
            $table->integer('ciclo_id');
            $table->integer('grado_id');
            $table->integer('turno_id');
            $table->integer('matricula_estado_id');
            $table->unsignedInteger('estado_id')->default(1);
            $table->dateTime('fecha');
            $table->decimal('monto_matricula', 12, 0)->default(0);
            $table->decimal('monto_cuota', 12, 0)->default(0);
            $table->dateTime('fecha_inicio');
            $table->integer('cantidad_cuota')->default(0);
            $table->foreignId('usuario_alta')->references('id')->on('users');
            $table->integer('usuario_modificacion')->default(1);
            $table->timestamps();

            $table->foreign('alumno_id')->references('id')->on('alumno');
            $table->foreign('ciclo_id')->references('id')->on('ciclo');
            $table->foreign('grado_id')->references('id')->on('grado');
            $table->foreign('turno_id')->references('id')->on('turno');
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('matricula_estado_id')->references('id')->on('matricula_estado');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matricula');
        Schema::dropIfExists('paramentro_general');
        Schema::dropIfExists('matricula_estado');
    }
};
