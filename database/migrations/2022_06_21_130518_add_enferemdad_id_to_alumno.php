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
        Schema::table('alumno', function (Blueprint $table) {
            $table->integer('enfermedad_id')->default(0);
            $table->string('observacion_enfermedad', 255)->nullable();

            $table->foreign('enfermedad_id')->references('id')->on('enfermedad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumno', function (Blueprint $table) {
            $table->dropForeign(['enfermedad_id']);
            $table->dropColumn(['enfermedad_id']);
            $table->dropColumn(['observacion_enfermedad']);
        });
    }
};
