<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Examen;
use App\Models\IntentoExamen;
use App\Models\GrupoMateria;
use App\Models\User;

class ReporteDocenteController extends Controller
{
    public function index()
    {
        return view('docente.reportes.index');
    }

    public function calificaciones()
    {
        $examenes = Examen::with(['intentosExamenes.user'])
            ->whereHas('grupoMateria', fn($q) => $q->where('docente_id', Auth::id()))
            ->get();

        return view('docente.reportes.calificaciones', compact('examenes'));
    }

    public function promedios()
    {
        $promedios = Examen::select('grupo_materia_id')
            ->with('grupoMateria')
            ->withAvg('intentosExamenes', 'calificacion')
            ->whereHas('grupoMateria', fn($q) => $q->where('docente_id', Auth::id()))
            ->get();

        return view('docente.reportes.promedios', compact('promedios'));
    }

    public function preguntasPorExamen()
    {
        $datos = Examen::withCount('preguntas')
            ->whereHas('grupoMateria', fn($q) => $q->where('docente_id', Auth::id()))
            ->get();

        return view('docente.reportes.preguntas', compact('datos'));
    }

    public function estudiantesPorCurso()
    {
        $cursos = GrupoMateria::with('users')
            ->where('docente_id', Auth::id())
            ->get();

        return view('docente.reportes.estudiantes', compact('cursos'));
    }

    public function rendimientoIndividual($alumno_id)
    {
        $intentos = IntentoExamen::with('examen')
            ->where('alumno_id', $alumno_id)
            ->get();

        $alumno = User::findOrFail($alumno_id);

        return view('docente.reportes.rendimiento', compact('intentos', 'alumno'));
    }
}
