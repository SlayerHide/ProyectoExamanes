<x-layouts.app title="Historial de Exámenes">
    <div class="min-h-screen p-8 bg-gradient-to-br from-indigo-100 to-purple-200 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-6xl mx-auto">

            @if (session('status'))
                <div class="mb-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <h1 class="text-3xl font-extrabold text-purple-800 dark:text-purple-300 mb-8 text-center">
                🧾 Historial de Exámenes Contestados
            </h1>

            <div class="flex justify-end mb-6">
                <a href="{{ route('alumno.historial.pdf') }}"
                   class="inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-medium shadow transition">
                    📥 Descargar PDF
                </a>
            </div>

            <div class="overflow-x-auto bg-white dark:bg-gray-900 border border-purple-300 dark:border-purple-700 rounded-xl shadow-lg">
                <table class="min-w-full text-sm text-purple-900 dark:text-gray-100">
                    <thead class="bg-purple-200 dark:bg-purple-700 text-purple-900 dark:text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-left">Examen</th>
                            <th class="px-4 py-3 text-left">Inicio</th>
                            <th class="px-4 py-3 text-left">Finalización</th>
                            <th class="px-4 py-3 text-left">Calificación</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-purple-100 dark:divide-purple-700">
                        @forelse ($intentos as $intento)
                            <tr class="hover:bg-purple-50 dark:hover:bg-purple-800 transition">
                                <td class="px-4 py-3 font-medium">{{ $intento->examen->titulo }}</td>
                                <td class="px-4 py-3">{{ $intento->fecha_inicio }}</td>
                                <td class="px-4 py-3">{{ $intento->fecha_fin ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-block px-3 py-1 rounded-full font-semibold
                                        {{ $intento->calificacion >= 70 
                                            ? 'bg-green-200 text-green-800'
                                            : 'bg-red-200 text-red-800' }}">
                                        {{ number_format($intento->calificacion, 2) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 dark:text-gray-400 py-6 italic">
                                    Aún no has contestado ningún examen.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-layouts.app>
