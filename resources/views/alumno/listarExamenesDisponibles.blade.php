<x-layouts.app title="Exámenes Disponibles">
    <div class="min-h-screen p-8 bg-gradient-to-tr from-indigo-100 to-purple-200 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-3xl font-extrabold text-purple-800 dark:text-purple-300 mb-8 text-center">
                📝 Exámenes Disponibles
            </h1>

            @forelse($examenes as $examen)
    @php
        $yaHecho = $examen->intentosExamenes
            ->where('alumno_id', Auth::id())
            ->whereNotNull('fecha_fin')
            ->isNotEmpty();
    @endphp

    <div class="bg-white dark:bg-gray-900 border-l-8 border-purple-500 p-6 rounded-2xl shadow-md mb-6 hover:shadow-lg transition">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300">{{ $examen->titulo }}</h2>
                <p class="text-gray-700 dark:text-gray-300 mt-1">{{ $examen->descripcion }}</p>
                <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">
                    ⏱️ <strong>Duración:</strong> {{ $examen->duracion }} min
                </p>
            </div>

            <div class="text-right">
                @if($yaHecho)
                    <span class="inline-block mt-2 bg-gray-300 dark:bg-gray-700 text-white px-5 py-2 rounded-lg font-medium cursor-not-allowed">
                        ✅ Ya contestado
                    </span>
                @else
                    <a href="{{ route('alumno.examenes.mostrar', $examen->id) }}"
                       class="inline-block mt-2 bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg font-medium transition">
                        🚀 Iniciar examen
                    </a>
                @endif
            </div>
        </div>
    </div>
@empty
    <div class="text-center bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded shadow-md">
        No tienes exámenes asignados actualmente.
    </div>
@endforelse

        </div>
    </div>
</x-layouts.app>
