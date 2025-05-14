<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materia;
use App\Models\Examen;

class ExamenController extends Controller
{
    public function crear()
    {
        $materias = Auth::user()->materiasDocente;
        return view('teacher.exams.crear', compact('materias'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Examen::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'materia_id' => $request->materia_id,
            'docente_id' => Auth::id(),
        ]);

        return redirect()->route('docente.examenes.crear')->with('success', 'Examen creado exitosamente.');
    }
}
