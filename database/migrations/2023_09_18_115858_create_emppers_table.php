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
        Schema::create('emppers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEmp')->nulleable('false');
            $table->unsignedBigInteger('idPer')->nulleable('false');
            $table->boolean('activo')->nulleable('false');
            $table->timestamps();
            $table->foreign('idEmp')->references('id')->on('empresas');
            $table->foreign('idPer')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emppers');
    }
};
