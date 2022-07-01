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
        Schema::create('nacionalidad', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 100);
            $table->unsignedInteger('estado_id')->default(1);
            $table->foreignId('usuario_grabacion')->references('id')->on('users');
            $table->integer('usuario_modificacion')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('nacionalidad');
    }
};
