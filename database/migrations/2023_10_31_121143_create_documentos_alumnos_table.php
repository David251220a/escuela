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
        Schema::create('documentos_alumnos', function (Blueprint $table) {
            $table->id();
            $table->integer('alumno_id')->default(0);
            $table->integer('ciclo_id')->default(0);
            $table->string('pdf', 250);
            $table->integer('leido')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_alumnos');
    }
};
