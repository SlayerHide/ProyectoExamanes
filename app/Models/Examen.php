<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\IntentoExamen;

class Examen extends Model
{
    protected $table = 'examenes';
    protected $fillable = ['titulo', 'descripcion', 'grupo_materia_id', 'duracion'];

    public function preguntas()
{
    return $this->hasMany(Pregunta::class);
}


    public function grupoMateria()
    {
        return $this->belongsTo(GrupoMateria::class, 'grupo_materia_id');
    }

    public function intentosExamenes()
    {
        return $this->hasMany(IntentoExamen::class);
    }
}
