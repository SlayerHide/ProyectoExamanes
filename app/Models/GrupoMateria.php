<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoMateria extends Model
{
    protected $table = 'grupos_materias';
    protected $fillable = ['nombre', 'materia', 'docente_id'];

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'alumno_grupo_materia', 'grupo_materia_id', 'alumno_id')->withTimestamps();
    }
}
