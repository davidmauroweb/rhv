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
        Schema::create('sucesos', function (Blueprint $table) {
            $table->id();
            $table->string('nombresuc',20)->nullable('false')->unique();
            $table->string('desc', 1000)->nullable();
            $table->unsignedSmallInteger('vigencia')->nullable('false');
            $table->unsignedTinyInteger('tipo');
            /**
             * En tipo va hardcodeado en la vista:
             * 0 - Vehículos
             * 1 - Salud
             * 2 - Seguridad
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
        Schema::dropIfExists('sucesos');
    }
};
