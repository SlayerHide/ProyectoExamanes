<x-layouts.app title="Reporte de Calificaciones">
    <div class="min-h-screen p-8 bg-gradient-to-br from-indigo-100 to-purple-200 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-extrabold text-purple-800 dark:text-purple-300 mb-10 text-center">
                📄 Calificaciones por Examen
            </h1>

            @foreach ($examenes as $examen)
                <div class="bg-white dark:bg-gray-900 p-6 mb-8 rounded-2xl border-l-8 border-purple-400 shadow-md hover:shadow-lg transition">
                    <h2 class="text-2xl font-bold text-purple-700 dark:text-purple-300 mb-4">
                        {{ $examen->titulo }}
                    </h2>

                    @if ($examen->intentosExamenes->isEmpty())
                        <div class="bg-yellow-100 text-yellow-800 p-4 rounded shadow-sm text-sm">
                            No hay calificaciones registradas para este examen.
                        </div>
                    @else
                        <div class="overflow-x-auto mt-2 rounded-lg border border-purple-200 dark:border-purple-700">
                            <table class="min-w-full divide-y divide-purple-100 dark:divide-purple-700 text-sm text-purple-900 dark:text-gray-200">
                                <thead class="bg-purple-200 dark:bg-purple-800 text-purple-900 dark:text-white uppercase text-xs tracking-wide">
                                    <tr>
                                        <th class="px-4 py-3 text-left">Alumno</th>
                                        <th class="px-4 py-3 text-left">Fecha</th>
                                        <th class="px-4 py-3 text-left">Calificación</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-purple-100 dark:divide-gray-700">
                                    @foreach ($examen->intentosExamenes as $intento)
                                        <tr class="hover:bg-purple-50 dark:hover:bg-gray-800 transition">
                                            <td class="px-4 py-2">{{ $intento->user->name }}</td>
                                            <td class="px-4 py-2">{{ $intento->fecha_fin ?? '-' }}</td>
                                            <td class="px-4 py-2">
                                                <span class="inline-block px-3 py-1 rounded-full font-semibold
                                                    {{ $intento->calificacion >= 70
                                                        ? 'bg-green-200 text-green-800'
                                                        : 'bg-red-200 text-red-800' }}">
                                                    {{ $intento->calificacion ?? 'N/A' }}
                                                </span>
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
    </div>
</x-layouts.app>
