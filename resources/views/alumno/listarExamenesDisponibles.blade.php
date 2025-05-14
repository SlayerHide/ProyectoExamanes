<x-layouts.app title="Exámenes Disponibles">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Exámenes disponibles para ti</h1>

        @forelse($examenes as $examen)
            <div class="mb-4 p-4 border rounded">
                <h2 class="text-lg font-semibold">{{ $examen->titulo }}</h2>
                <p>{{ $examen->descripcion }}</p>
                <p><strong>Duración:</strong> {{ $examen->duracion }} minutos</p>

                <a href="{{ route('alumno.examenes.mostrar', $examen->id) }}" class="mt-2 inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                    Iniciar examen
                </a>
            </div>
        @empty
            <p class="text-gray-700">No tienes exámenes asignados actualmente.</p>
        @endforelse
    </div>
</x-layouts.app>
