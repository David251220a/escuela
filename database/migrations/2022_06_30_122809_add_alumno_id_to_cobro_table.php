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
        Schema::table('cobro', function (Blueprint $table) {
            $table->unsignedInteger('alumno_id');
            $table->integer('grado_id');
            $table->integer('turno_id');
            $table->integer('ciclo_id');

            $table->foreign('alumno_id')->references('id')->on('alumno');
            $table->foreign('grado_id')->references('id')->on('grado');
            $table->foreign('turno_id')->references('id')->on('turno');
            $table->foreign('ciclo_id')->references('id')->on('ciclo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cobro', function (Blueprint $table) {
            $table->dropForeign(['alumno_id']);
            $table->dropForeign(['grado_id']);
            $table->dropForeign(['turno_id']);
            $table->dropForeign(['ciclo_id']);

            $table->dropColumn(['alumno_id']);
            $table->dropColumn(['grado_id']);
            $table->dropColumn(['turno_id']);
            $table->dropColumn(['ciclo_id']);
        });
    }
};
