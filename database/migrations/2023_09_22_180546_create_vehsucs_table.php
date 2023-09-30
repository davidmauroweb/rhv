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
        Schema::create('vehsucs', function (Blueprint $table) {
            $table->integerIncrements('idvehsuc');
            $table->unsignedBigInteger('idVeh');
            $table->unsignedBigInteger('idSuc');
            $table->timestamps();
            $table->foreign('idVeh')->references('id')->on('vehiculos'); 
            $table->foreign('idSuc')->references('id')->on('sucesos'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehsucs');
    }
};
