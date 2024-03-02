<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('numero_ci');

            $table->string('nombre', 100);

            $table->string('direccion');

            $table->integer('telefono')->unique();

            $table->string("estado");
        });

        Schema::create('clientes_estatales', function (Blueprint $table) {
            $table->id('numero_ci');

            $table->foreign('numero_ci')
                ->references('numero_ci')
                ->on('clientes')
                ->onDelete('cascade');

            $table->boolean('arrendada');
        });

        Schema::create('clientes_residenciales', function (Blueprint $table) {
            $table->id('numero_ci');

            $table->foreign('numero_ci')
                ->references('numero_ci')
                ->on('clientes')
                ->onDelete('cascade');

            $table->boolean('matutino');
            $table->boolean('rastreo');
        });

        Schema::create('llamadas', function (Blueprint $table) {
            $table->id('id_llamada');

            $table->integer('numero_realizo');
            $table->integer('numore_llamo');

            $table->foreign('numero_realizo')
                ->references('telefono')
                ->on('clientes')
                ->onDelete('cascade');

            $table->timestamp('fecha');
            $table->time('hora');

            $table->float('minutos');
        });

        Schema::create('llamadas_internacionales', function (Blueprint $table) {
            $table->id('id_llamada');

            $table->foreign('id_llamada')
                ->references('id_llamada')
                ->on('llamadas')
                ->onDelete('cascade');

            $table->float('tarifa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
        Schema::dropIfExists('clientes_estatales');
        Schema::dropIfExists('clientes_residenciales');
        Schema::dropIfExists('contratos');
        Schema::dropIfExists('llamadas');
        Schema::dropIfExists('llamadas_internacionales');
    }
};
