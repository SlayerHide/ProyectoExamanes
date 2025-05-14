<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';
    protected $fillable = ['examen_id', 'contenido', 'tipo', 'porcentaje', 'retroalimentacion'];

   public function opciones()
{
    return $this->hasMany(Opcion::class);
}

public function examen()
{
    return $this->belongsTo(Examen::class);
}

}
