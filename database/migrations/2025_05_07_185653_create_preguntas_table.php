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
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('examen_id');
            $table->text('contenido');
            $table->enum('tipo', ['opcion_multiple', 'verdadero_falso']);
            $table->decimal('porcentaje');
            $table->text('retroalimentacion');
            $table->timestamps();
            $table->foreign('examen_id')->references('id')->on('examenes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
