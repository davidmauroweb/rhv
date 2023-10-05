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
        Schema::create('empsucs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEmp')->nulleable('false');
            $table->unsignedBigInteger('idSuc')->nulleable('false');
            $table->timestamps();
            $table->foreign('idEmp')->references('id')->on('empresas');
            $table->foreign('idSuc')->references('id')->on('sucesos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empsucs');
    }
};
