<x-layouts.app title="Resultados de Exámenes">
    <div class="p-6 min-h-screen bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-gray-800 dark:to-gray-900 text-gray-800 dark:text-white">
        <h1 class="text-4xl font-extrabold text-center text-purple-800 dark:text-purple-300 mb-10">📊 Resultados de tus alumnos</h1>

        @foreach($examenes as $examen)
            <div class="mb-10 rounded-xl shadow-lg border border-purple-300 dark:border-purple-600 bg-white dark:bg-gray-800 p-6 transition hover:shadow-xl">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-purple-700 dark:text-purple-300">
                            {{ $examen->titulo }}
                        </h2>
                        <p class="text-sm text-purple-600 dark:text-purple-400">
                            {{ $examen->grupoMateria->nombre ?? 'N/A' }} - {{ $examen->grupoMateria->materia ?? 'N/A' }}
                        </p>
                    </div>
                    <div class="text-right">
                        <span class="px-3 py-1 text-xs rounded-full bg-purple-200 dark:bg-purple-600 text-purple-800 dark:text-white">
                            Total intentos: {{ $examen->intentosExamenes->count() }}
                        </span>
                    </div>
                </div>

                @if($examen->intentosExamenes->isEmpty())
                    <div class="text-center text-gray-500 dark:text-gray-400 italic py-4">
                        Ningún alumno ha realizado este examen todavía.
                    </div>
                @else
                    <div class="overflow-x-auto rounded-lg border border-purple-200 dark:border-purple-700">
                        <table class="min-w-full divide-y divide-purple-200 dark:divide-purple-600">
                            <thead class="bg-purple-100 dark:bg-purple-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-purple-800 dark:text-white uppercase tracking-wider">Alumno</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-purple-800 dark:text-white uppercase tracking-wider">Inicio</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-purple-800 dark:text-white uppercase tracking-wider">Fin</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-purple-800 dark:text-white uppercase tracking-wider">Calificación</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-purple-100 dark:divide-purple-600">
                                @foreach ($examen->intentosExamenes as $intento)
                                    <tr class="hover:bg-purple-50 dark:hover:bg-purple-900 transition">
                                        <td class="px-4 py-3 font-medium">{{ $intento->user->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3">{{ $intento->fecha_inicio }}</td>
                                        <td class="px-4 py-3">{{ $intento->fecha_fin ?? '---' }}</td>
                                        <td class="px-4 py-3 font-bold text-purple-700 dark:text-purple-300">
                                            {{ number_format($intento->calificacion, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</x-layouts.app>
