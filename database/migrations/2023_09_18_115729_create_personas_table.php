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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',20)->nulleable('false')->unique();
            $table->string('dni',8)->nulleable('false')->unique();
            $table->boolean('sx')->nulleable('false');
            $table->date('ingreso')->nulleable('false');
            $table->boolean('activo')->nulleable('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
