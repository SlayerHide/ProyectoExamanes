<x-layouts.app title="Rendimiento de {{ $alumno->name }}">
    <div class="min-h-screen p-8 bg-gradient-to-tr from-indigo-100 to-purple-200 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-4xl font-extrabold text-purple-800 dark:text-purple-300 mb-4 text-center">
                🎯 Rendimiento de {{ $alumno->name }}
            </h1>
            <p class="text-center text-gray-700 dark:text-gray-300 text-sm mb-10">
                Correo: <span class="font-medium">{{ $alumno->email }}</span>
            </p>

            @if ($intentos->isEmpty())
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded shadow-sm text-center">
                    Este alumno no ha realizado ningún examen.
                </div>
            @else
                <div class="overflow-x-auto bg-white dark:bg-gray-900 border border-purple-300 dark:border-purple-700 rounded-2xl shadow-xl">
                    <table class="min-w-full divide-y divide-purple-100 dark:divide-purple-700 text-sm text-purple-900 dark:text-gray-100">
                        <thead class="bg-purple-200 dark:bg-purple-700 text-purple-900 dark:text-white uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-left">Examen</th>
                                <th class="px-4 py-3 text-left">Inicio</th>
                                <th class="px-4 py-3 text-left">Finalización</th>
                                <th class="px-4 py-3 text-left">Calificación</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-purple-100 dark:divide-gray-700">
                            @foreach ($intentos as $intento)
                                <tr class="hover:bg-purple-50 dark:hover:bg-purple-800 transition">
                                    <td class="px-4 py-3 font-semibold">{{ $intento->examen->titulo }}</td>
                                    <td class="px-4 py-3">{{ $intento->fecha_inicio }}</td>
                                    <td class="px-4 py-3">{{ $intento->fecha_fin ?? '⏳ No finalizado' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-block px-3 py-1 rounded-full font-semibold
                                            {{ $intento->calificacion >= 70 
                                                ? 'bg-green-200 text-green-800'
                                                : 'bg-red-200 text-red-800' }}">
                                            {{ $intento->calificacion !== null ? number_format($intento->calificacion, 2) : 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
