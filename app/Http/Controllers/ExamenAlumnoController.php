<?php
namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\IntentoExamen;
use App\Models\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ExamenAlumnoController extends Controller
{
    public function mostrar($id)
    {
        $examen = Examen::with('preguntas.opciones')->findOrFail($id);

        $intento = IntentoExamen::where('alumno_id', Auth::id())
            ->where('examen_id', $examen->id)
            ->latest()
            ->first();

        // 🚫 Ya fue entregado
        if ($intento && $intento->fecha_fin !== null) {
            return redirect()->route('dashboard.alumno')->with('status', 'Ya realizaste este examen.');
        }

        $tiempoMaximo = $examen->duracion * 60;
        $tiempoRestante = $tiempoMaximo;

        if ($intento) {
            $inicio = Carbon::parse($intento->fecha_inicio);
            $tiempoPasado = now()->diffInSeconds($inicio);
            $tiempoRestante = max(0, $tiempoMaximo - $tiempoPasado);

            // ⏱ Tiempo agotado y aún sin cerrar
            if ($tiempoPasado >= $tiempoMaximo) {
                $intento->update([
                    'fecha_fin' => now(),
                    'calificacion' => 0,
                ]);

                return redirect()->route('dashboard.alumno')->with('status', 'Tu tiempo terminó. Calificación: 0.');
            }
        } else {
            $intento = IntentoExamen::create([
                'alumno_id' => Auth::id(),
                'examen_id' => $examen->id,
                'fecha_inicio' => now(),
            ]);
        }

        return view('alumno.contestarExamen', compact('examen', 'intento', 'tiempoRestante'));
    }

    public function guardar(Request $request, $id)
    {
        $examen = Examen::with('preguntas.opciones')->findOrFail($id);

        $intento = IntentoExamen::where('alumno_id', Auth::id())
            ->where('examen_id', $examen->id)
            ->whereNull('fecha_fin')
            ->first();

        if (!$intento) {
            return redirect()->route('dashboard.alumno')->with('status', 'Este examen ya fue entregado o expiró.');
        }

        // ⏱ Revalidar tiempo restante al guardar
        $inicio = Carbon::parse($intento->fecha_inicio);
        $tiempoPasado = now()->diffInSeconds($inicio);
        $tiempoMaximo = $examen->duracion * 60;

        if ($tiempoPasado >= $tiempoMaximo) {
            $intento->update([
                'fecha_fin' => now(),
                'calificacion' => 0,
            ]);

            return redirect()->route('dashboard.alumno')->with('status', 'Tu tiempo terminó. Calificación: 0.');
        }

        $total = 0;
        $correctas = 0;

        foreach ($examen->preguntas as $pregunta) {
            $respuestaID = $request->input("respuesta_{$pregunta->id}");

            if (!$respuestaID) continue;

            $opcion = $pregunta->opciones->firstWhere('id', $respuestaID);
            $esCorrecta = $opcion && $opcion->es_correcta;

            Respuesta::create([
                'intento_examen_id' => $intento->id,
                'pregunta_id' => $pregunta->id,
                'opcion_id' => $respuestaID,
                'es_correcta' => $esCorrecta,
            ]);

            if ($esCorrecta) {
                $correctas++;
                $total += $pregunta->porcentaje;
            }
        }

        $intento->update([
            'fecha_fin' => now(),
            'calificacion' => round($total, 2),
        ]);

        return view('alumno.resultadoExamen', [
            'calificacion' => $intento->calificacion,
            'total_preguntas' => $examen->preguntas->count(),
            'correctas' => $correctas
        ]);
    }

    public function listar()
    {
        $user = Auth::user();

        $examenes = Examen::whereHas('grupoMateria.users', function ($q) use ($user) {
            $q->where('users.id', $user->id);
        })->get();

        return view('alumno.listarExamenesDisponibles', compact('examenes'));
    }

    public function historial()
    {
        $intentos = IntentoExamen::with('examen')
            ->where('alumno_id', Auth::id())
            ->get();

        return view('alumno.historial', compact('intentos'));
    }

    public function exportarPDF()
    {
        $intentos = IntentoExamen::with('examen')->where('alumno_id', Auth::id())->get();
        $pdf = Pdf::loadView('alumno.exportar_pdf', compact('intentos'));
        return $pdf->download('historial_examenes.pdf');
    }
}
