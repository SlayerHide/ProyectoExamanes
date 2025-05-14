<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntentoExamen extends Model
{
    protected $table = 'intentos_examenes';

    protected $fillable = [
        'alumno_id',
        'examen_id',
        'calificacion',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }

    // Acceso rápido al alumno como "user"
    public function user()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }
}
