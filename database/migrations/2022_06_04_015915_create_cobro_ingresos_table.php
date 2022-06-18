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
        Schema::create('cobro_ingreso_concepto', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 200);
            $table->unsignedInteger('estado_id')->default(1);
            $table->decimal('precio', 12, 0)->default(0);
            $table->char('unico', 1)->default(0);
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('ingreso_estado', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 100);
        });

        Schema::create('cobro_ingreso', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cobro_id');
            $table->string('factura_sucursal', 3)->nullable(' ');
            $table->string('factura_general', 3)->nullable(' ');
            $table->string('factura_nro', 6)->nullable(' ');
            $table->decimal('precio', 12, 0)->default(0);
            $table->decimal('monto_total_factura', 12, 0)->default(0);
            $table->decimal('monto_cobrado_factura', 12, 0)->default(0);
            $table->decimal('monto_saldo_factura', 12, 0)->default(0);
            $table->integer('cantidad')->default(0);
            $table->integer('ciclo_id')->default(0);
            $table->integer('cobro_ingreso_concepto')->default(0);
            $table->unsignedInteger('estado_id')->default(1);
            $table->integer('ingreso_estado_id')->default(0);
            $table->integer('alumno_id')->default(0);
            $table->integer('padre_ingreso_id')->default(0);
            $table->foreignId('usuario_alta')->references('id')->on('users');
            $table->integer('usuario_modificacion')->default(1);
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('cobro_id')->references('id')->on('cobro');
            $table->foreign('ingreso_estado_id')->references('id')->on('ingreso_estado');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cobro_ingreso');
        Schema::dropIfExists('cobro_ingreso_concepto');
        Schema::dropIfExists('ingreso_estado');
    }
};
