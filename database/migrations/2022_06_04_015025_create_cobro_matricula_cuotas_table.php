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
        Schema::create('cobro_matricula_cuota', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cobro_id');
            $table->string('factura_sucursal', 3)->nullable(' ');
            $table->string('factura_general', 3)->nullable(' ');
            $table->string('factura_nro', 6)->nullable(' ');
            $table->decimal('monto_total_cuota', 12, 0)->default(0);
            $table->decimal('monto_saldo_cuota', 12, 0)->default(0);
            $table->decimal('monto_cobrado_cuota', 12, 0)->default(0);
            $table->integer('matricula_cuota_id')->default(0);
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
        Schema::dropIfExists('cobro_matricula_cuota');
    }
};
