<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function docentes()
    {
        return $this->belongsToMany(User::class, 'subject_teacher', 'materia_id', 'docente_id');
    }

    public function alumnos()
    {
        return $this->belongsToMany(User::class, 'subject_student', 'materia_id', 'alumno_id');
    }

    public function examenes()
    {
        return $this->hasMany(Examen::class);
    }
}
