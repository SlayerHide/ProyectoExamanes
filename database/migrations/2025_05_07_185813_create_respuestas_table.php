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
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intento_examen_id');
            $table->unsignedBigInteger('pregunta_id');
            $table->unsignedBigInteger('opcion_id')->nullable(); // puede ser null para verdadero/falso
            $table->boolean('es_correcta');
            $table->timestamps();
            $table->foreign('intento_examen_id')->references('id')->on('intentos_examenes')->onDelete('cascade');
            $table->foreign('pregunta_id')->references('id')->on('preguntas')->onDelete('cascade');
            $table->foreign('opcion_id')->references('id')->on('opciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas');
    }
};
