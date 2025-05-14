<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\IntentoExamen;
use App\Models\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamenAlumnoController extends Controller
{
    public function mostrar($id)
    {
        $examen = Examen::with('preguntas.opciones')->findOrFail($id);
        return view('alumno.contestarExamen', compact('examen'));
    }

    public function guardar(Request $request, $id)
    {
        $examen = Examen::with('preguntas.opciones')->findOrFail($id);

        $intento = IntentoExamen::create([
            'alumno_id' => Auth::id(),
            'examen_id' => $examen->id,
            'fecha_inicio' => now(),
            'fecha_fin' => now(),
        ]);

        $total = 0;
        $correctas = 0;

        foreach ($examen->preguntas as $pregunta) {
            $opcion_id = $request->input("respuesta_{$pregunta->id}");

            $opcionCorrecta = $pregunta->opciones->firstWhere('id', $opcion_id);
            $esCorrecta = $opcionCorrecta && $opcionCorrecta->es_correcta;

            Respuesta::create([
                'intento_examen_id' => $intento->id,
                'pregunta_id' => $pregunta->id,
                'opcion_id' => $opcion_id,
                'es_correcta' => $esCorrecta,
            ]);

            if ($esCorrecta) {
                $correctas++;
                $total += $pregunta->porcentaje;
            }
        }

        $intento->calificacion = round($total, 2);
        $intento->save();

        return view('alumno.resultadoExamen', [
            'calificacion' => $intento->calificacion,
            'total_preguntas' => $examen->preguntas->count(),
            'correctas' => $correctas
        ]);
    }

    public function listar()
{
    $user = Auth::user();

    // Exámenes asignados al alumno (según su grupo)
    $examenes = Examen::whereHas('grupoMateria.users', function ($q) use ($user) {
        $q->where('users.id', $user->id);
    })->get();

    return view('alumno.listarExamenesDisponibles', compact('examenes'));
}

}
