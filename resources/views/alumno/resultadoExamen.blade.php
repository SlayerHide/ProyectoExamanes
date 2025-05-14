<x-layouts.app title="Resultado del Examen">
    <div class="p-6 text-center">
        <h1 class="text-3xl font-bold text-purple-800 mb-4">¡Examen finalizado!</h1>

        <p class="text-xl text-gray-700 mb-2">Respondiste correctamente {{ $correctas }} de {{ $total_preguntas }} preguntas.</p>
        <p class="text-2xl font-semibold text-green-700">Calificación: {{ $calificacion }}%</p>

        <a href="{{ route('dashboard.alumno') }}" class="mt-4 inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
            Volver al inicio
        </a>
    </div>
</x-layouts.app>
