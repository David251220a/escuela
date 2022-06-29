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
        Schema::table('cobro_matricula_cuota', function (Blueprint $table) {
            $table->decimal('monto_multa_a_cobrar', 12, 0)->default(0);
            $table->decimal('monto_multa_a_cobrado', 12, 0)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cobro_matricula_cuota', function (Blueprint $table) {
            $table->dropColumn(['monto_multa_a_cobrar']);
            $table->dropColumn(['monto_multa_a_cobrado']);
        });
    }
};
