<x-layouts.app title="Resultados de Exámenes">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Resultados de tus alumnos</h1>

        @forelse($examenes as $examen)
            <div class="mb-6 border p-4 rounded">
                <h2 class="text-xl font-semibold mb-2">{{ $examen->titulo }}</h2>

                @if($examen->intentosExamenes->isEmpty())
                    <p class="text-gray-600">Ningún alumno ha realizado este examen todavía.</p>
                @else
                    <table class="w-full text-left border">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-2">Alumno</th>
                                <th class="p-2">Inicio</th>
                                <th class="p-2">Fin</th>
                                <th class="p-2">Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($examen->intentosExamenes as $intento)
                                <tr class="border-t">
                                    <td class="p-2">{{ $intento->user->name ?? 'N/A' }}</td>
                                    <td class="p-2">{{ $intento->fecha_inicio }}</td>
                                    <td class="p-2">{{ $intento->fecha_fin }}</td>
                                    <td class="p-2">{{ $intento->calificacion ?? 'Sin calificar' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @empty
            <p class="text-gray-700">No has creado exámenes aún.</p>
        @endforelse
    </div>
</x-layouts.app>
