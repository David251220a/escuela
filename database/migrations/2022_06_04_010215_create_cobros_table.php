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

        Schema::create('cobro_concepto', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 50);
            $table->foreignId('usuario_alta')->references('id')->on('users');
            $table->integer('usuario_modificacion');
            $table->unsignedInteger('estado_id');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
        });

        Schema::create('cobro', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('caja_id')->default('1');
            $table->integer('sede_id');
            $table->dateTime('fecha_cobro');
            $table->unsignedInteger('estado_id')->default(1);
            $table->integer('cobro_concepto_id')->default(1);
            $table->decimal('total_cobrado', 12, 0)->default(0);
            $table->string('observacion', 200);
            $table->integer('tipo_cobro_id');
            $table->integer('salida_id')->default(0);
            $table->integer('recibo_id')->default(0);
            $table->foreignId('usuario_alta')->references('id')->on('users');
            $table->integer('usuario_modificacion')->default(1);
            $table->timestamps();

            $table->foreign('sede_id')->references('id')->on('sede');
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('tipo_cobro_id')->references('id')->on('tipo_cobro');
        });

        Schema::create('cobro_matricula', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cobro_id');
            $table->string('factura_sucursal', 3)->nullable(' ');
            $table->string('factura_general', 3)->nullable(' ');
            $table->string('factura_nro', 6)->nullable(' ');
            $table->decimal('monto_total_factura', 12, 0)->default(0);
            $table->decimal('monto_saldo_factura', 12, 0)->default(0);
            $table->decimal('monto_cobrado_factura', 12, 0)->default(0);
            $table->integer('matricula_id')->default(0);
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreignId('usuario_alta')->references('id')->on('users');
            $table->integer('usuario_modificacion')->default(1);
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('cobro_id')->references('id')->on('cobro');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cobro_matricula');
        Schema::dropIfExists('cobro');
        Schema::dropIfExists('cobro_concepto');
    }
};
