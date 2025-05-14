<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoAlumnoMateria extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = 'alumno_grupo_materia';

    // Definir las columnas que pueden ser llenadas masivamente
    protected $fillable = [
        'alumno_id',
        'grupo_materia_id',
    ];

    /**
     * Relación con el modelo Alumno (User)
     */
    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    /**
     * Relación con el modelo GrupoMateria
     */
    public function grupoMateria()
    {
        return $this->belongsTo(GrupoMateria::class, 'grupo_materia_id');
    }
}
