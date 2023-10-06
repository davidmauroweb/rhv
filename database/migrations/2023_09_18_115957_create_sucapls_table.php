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
            $table->unsignedBigInteger('idPer')->nullable();
            $table->unsignedBigInteger('idVeh')->nullable();
            $table->unsignedBigInteger('idSuc');
            $table->date('fecha');
            $table->date('vence');         
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
