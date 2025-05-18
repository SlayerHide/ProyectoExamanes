<x-layouts.app title="Promedios por Materia">
    <div class="min-h-screen p-8 bg-gradient-to-tr from-indigo-100 to-purple-200 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-4xl font-extrabold text-purple-800 dark:text-purple-300 mb-10 text-center">
                📘 Promedios por Grupo y Materia
            </h1>

            <div class="overflow-x-auto bg-white dark:bg-gray-900 border border-purple-300 dark:border-purple-700 rounded-2xl shadow-xl">
                <table class="min-w-full divide-y divide-purple-100 dark:divide-purple-700 text-sm text-purple-900 dark:text-gray-100">
                    <thead class="bg-purple-200 dark:bg-purple-700 text-purple-900 dark:text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-left">Grupo - Materia</th>
                            <th class="px-4 py-3 text-left">Promedio</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-purple-100 dark:divide-gray-700">
                        @foreach ($promedios as $examen)
                            <tr class="hover:bg-purple-50 dark:hover:bg-purple-800 transition">
                                <td class="px-4 py-3 font-medium">
                                    {{ $examen->grupoMateria->nombre ?? '-' }} - {{ $examen->grupoMateria->materia ?? '-' }}
                                </td>
                                <td class="px-4 py-3 font-bold">
                                    <span class="inline-block px-3 py-1 rounded-full
                                        {{ $examen->intentos_examenes_avg_calificacion >= 70 
                                            ? 'bg-green-200 text-green-800' 
                                            : 'bg-red-200 text-red-800' }}">
                                        {{ number_format($examen->intentos_examenes_avg_calificacion, 2) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
