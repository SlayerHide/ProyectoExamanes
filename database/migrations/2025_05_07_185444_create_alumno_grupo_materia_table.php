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
        Schema::create('alumno_grupo_materia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->unsignedBigInteger('grupo_materia_id');
            $table->timestamps();
            $table->foreign('alumno_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('grupo_materia_id')->references('id')->on('grupos_materias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_grupo_materia');
    }
};
