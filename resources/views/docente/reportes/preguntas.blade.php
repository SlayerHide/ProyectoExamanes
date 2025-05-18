<x-layouts.app title="Preguntas por Examen">
    <div class="min-h-screen p-8 bg-gradient-to-tr from-indigo-100 to-purple-200 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-4xl font-extrabold text-purple-800 dark:text-purple-300 mb-10 text-center">
                🧠 Preguntas por Examen
            </h1>

            <div class="overflow-x-auto bg-white dark:bg-gray-900 border border-purple-300 dark:border-purple-700 rounded-2xl shadow-xl">
                <table class="min-w-full divide-y divide-purple-100 dark:divide-purple-700 text-sm text-purple-900 dark:text-gray-100">
                    <thead class="bg-purple-200 dark:bg-purple-700 text-purple-900 dark:text-white uppercase text-xs tracking-wide">
                        <tr>
                            <th class="px-4 py-3 text-left">Examen</th>
                            <th class="px-4 py-3 text-left">Grupo</th>
                            <th class="px-4 py-3 text-left"># Preguntas</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-purple-100 dark:divide-gray-700">
                        @foreach ($datos as $examen)
                            <tr class="hover:bg-purple-50 dark:hover:bg-purple-800 transition">
                                <td class="px-4 py-3 font-medium">{{ $examen->titulo }}</td>
                                <td class="px-4 py-3">{{ $examen->grupoMateria->nombre ?? '-' }}</td>
                                <td class="px-4 py-3 font-bold text-purple-800 dark:text-purple-200">
                                    {{ $examen->preguntas_count }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
