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
        Schema::create('tarjeta', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 50);
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_alta')->references('id')->on('users');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('tipo_cobro', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 50);
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_alta')->references('id')->on('users');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('banco', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 50);
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_alta')->references('id')->on('users');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('sede', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 50);
            $table->string('direccion', 150);
            $table->string('telefono', 20);
            $table->string('fax', 20);
            $table->string('correo', 100);
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_alta')->references('id')->on('users');
            $table->integer('usuario_modificacion')->default(1);
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('ciclo', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('sede_id');
            $table->integer('nombre');
            $table->integer('meses');
            $table->integer('año');
            $table->dateTime('fecha_inicio');
            $table->DateTime('fecha_fin');
            $table->unsignedInteger('estado_id');
            $table->foreignId('usuario_alta')->references('id')->on('users');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('sede_id')->references('id')->on('sede');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ciclo');
        Schema::dropIfExists('sede');
        Schema::dropIfExists('banco');
        Schema::dropIfExists('tipo_cobro');
        Schema::dropIfExists('tarjetas');
    }
};
