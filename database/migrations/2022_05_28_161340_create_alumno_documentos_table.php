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

        Schema::create('alumno_documento_concepto', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 100)->default(' ');
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->integer('usuario_modificacion');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('alumno_documento', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedInteger('alumno_id');
            $table->integer('concepto_id');
            $table->string('imagen', 255)->default(' ');
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->integer('usuario_modificacion');
            $table->timestamps();

            $table->foreign('alumno_id')->references('id')->on('alumno');
            $table->foreign('concepto_id')->references('id')->on('alumno_documento_concepto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_documento');
        Schema::dropIfExists('alumno_documento_concepto');
    }
};
