<?php
namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Pregunta;
use App\Models\Opcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamenDocenteController extends Controller
{
    public function crear()
    {
        return view('docente.crearExamen'); 

    }

    public function guardar(Request $request){
      try {
    $examen = Examen::create($request->only('titulo', 'descripcion', 'grupo_materia_id', 'duracion'));

    foreach ($request->preguntas as $preguntaData) {
        if (!isset($preguntaData['contenido'])) continue;

        $pregunta = $examen->preguntas()->create([
            'contenido' => $preguntaData['contenido'],
            'tipo' => $preguntaData['tipo'],
            'porcentaje' => $preguntaData['porcentaje'],
            'retroalimentacion' => $preguntaData['retroalimentacion'] ?? '',
        ]);

        foreach ($preguntaData['opciones'] as $opcionData) {
            $pregunta->opciones()->create([
                'texto' => $opcionData['texto'],
                'es_correcta' => isset($opcionData['es_correcta']) && $opcionData['es_correcta'],
            ]);
        }
    }

    return redirect()->route('dashboard.docente')->with('status', 'Examen guardado con éxito.');
} catch (\Throwable $e) {
    dd('ERROR AL GUARDAR', $e->getMessage(), $e->getTraceAsString());
}

    }

    // Mostrar listado de exámenes
public function index()
{
    $examenes = Examen::whereHas('grupoMateria', function ($q) {
        $q->where('docente_id', Auth::id());
    })->get();

    return view('docente.listarExamenes', compact('examenes'));
}

// Mostrar formulario de edición
public function editar($id)
{
    $examen = Examen::with('preguntas.opciones')->findOrFail($id);
    return view('docente.editarExamen', compact('examen'));
}

// Actualizar examen
public function actualizar(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required|string',
        'descripcion' => 'nullable|string',
        'duracion' => 'required|integer|min:1',
        'preguntas' => 'required|array',
    ]);

    $examen = Examen::findOrFail($id);
    $examen->update($request->only('titulo', 'descripcion', 'duracion'));

    // Elimina las anteriores preguntas y opciones
    foreach ($examen->preguntas as $pregunta) {
        $pregunta->opciones()->delete();
        $pregunta->delete();
    }

    foreach ($request->preguntas as $preguntaData) {
        $pregunta = $examen->preguntas()->create([
            'contenido' => $preguntaData['contenido'],
            'tipo' => $preguntaData['tipo'],
            'porcentaje' => $preguntaData['porcentaje'],
            'retroalimentacion' => $preguntaData['retroalimentacion'] ?? '',
        ]);

        foreach ($preguntaData['opciones'] as $opcionData) {
            $pregunta->opciones()->create([
                'texto' => $opcionData['texto'],
                'es_correcta' => isset($opcionData['es_correcta']) && $opcionData['es_correcta'],
            ]);
        }
    }

    return redirect()->route('docente.examenes.index')->with('status', 'Examen actualizado correctamente.');
}

// Eliminar examen
public function eliminar($id)
{
    $examen = Examen::findOrFail($id);
    $examen->delete();

    return redirect()->route('docente.examenes.index')->with('status', 'Examen eliminado correctamente.');
}

public function resultados()
{
    // Opcional: traer los exámenes del docente con sus intentos
    $examenes = Examen::with('intentosExamenes.user')
        ->whereHas('grupoMateria', function ($q) {
            $q->where('docente_id', Auth::id());
        })->get();

    return view('docente.resultados', compact('examenes'));
}


}
