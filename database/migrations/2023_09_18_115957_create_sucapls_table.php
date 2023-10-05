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
        Schema::create('sucapls', function (Blueprint $table) {
            $table->integerIncrements('idsucapl');
            $table->unsignedBigInteger('idPer');
            $table->unsignedBigInteger('idVeh');
            $table->unsignedBigInteger('idSuc')->nulleable('false');
            $table->date('fecha');
            $table->date('vence');
            $table->foreign('idPer')->references('id')->on('personas');
            $table->foreign('idVeh')->references('id')->on('vehiculos');            
            $table->foreign('idSuc')->references('id')->on('sucesos');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucapls');
    }
};
