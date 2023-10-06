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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('patente', 7)->nullable('fales')->unique();
            $table->string('marca', 20)->nullable('fales');
            $table->year('modelo')->nullable('fales');
            $table->string('tipo', 10)->nullable('fales');
            /**
             * En tipo va hardcodeado en la vista:
             * 0 - Automovil
             * 1 - Furgón
             * 2 - Pick-up
             * 3 - Camión
             * 4 - Otros
             */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
