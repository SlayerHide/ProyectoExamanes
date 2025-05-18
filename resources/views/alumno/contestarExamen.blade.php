<x-layouts.app title="Contestar Examen">

    <div class="p-6 max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Examen: {{ $examen->titulo }}</h1>

        <form action="{{ route('alumno.examenes.guardar', $examen->id) }}" method="POST">
            @csrf

            @foreach ($examen->preguntas as $pregunta)
                <div class="mb-6 p-4 border rounded">
                    <h2 class="text-lg font-semibold">{{ $loop->iteration }}. {{ $pregunta->contenido }}</h2>

                    @foreach ($pregunta->opciones as $opcion)
                        <label class="block mt-2">
                            <input type="radio" name="respuesta_{{ $pregunta->id }}" value="{{ $opcion->id }}" required>
                            {{ $opcion->texto }}
                        </label>
                    @endforeach
                </div>
            @endforeach

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Enviar examen
            </button>
        </form>
    </div>

    <audio id="alarma" src="{{ asset('sounds/alarma.mp3') }}"></audio>

</x-layouts.app>
