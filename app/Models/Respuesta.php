<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $table = 'respuestas';

    protected $fillable = [
        'intento_examen_id',
        'pregunta_id',
        'opcion_id',
        'es_correcta',
    ];

    public function intentoExamen()
    {
        return $this->belongsTo(IntentoExamen::class);
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }

    public function opcion()
    {
        return $this->belongsTo(Opcion::class);
    }
}
