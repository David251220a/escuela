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
        Schema::create('matricula_cuotas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('matricula_id');
            $table->integer('cuota');
            $table->date('fecha_vencimiento');
            $table->decimal('monto_cuota_cobrar', 12, 0)->default(0);
            $table->decimal('monto_cuota_cobrado', 12, 0)->default(0);
            $table->decimal('monto_multa_cobrar', 12, 0)->default(0);
            $table->decimal('monto_multa_cobrado', 12, 0)->default(0);
            $table->decimal('monto_cobrado', 12, 0)->default(0);
            $table->decimal('saldo', 12, 0)->default(0);
            $table->decimal('total_cuota', 12, 0)->default(0);
            $table->foreignId('usuario_alta')->references('id')->on('users');
            $table->integer('usuario_modificacion')->default(1);
            $table->unsignedInteger('estado_id')->default(1);
            $table->timestamps();

            $table->foreign('matricula_id')->references('id')->on('matricula');
            $table->foreign('estado_id')->references('id')->on('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matricula_cuotas');
    }
};
