<x-layouts.app title="Reportes y Estadísticas">
    <div class="min-h-screen p-10 bg-gradient-to-r from-slate-100 via-gray-200 to-slate-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-gray-800 dark:text-white">📊 Reportes y Estadísticas</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 mt-2">Explora el rendimiento académico de tus alumnos</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Calificaciones --}}
                <a href="{{ route('docente.reportes.calificaciones') }}"
                   class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border-l-8 border-blue-500 hover:scale-[1.02] transition">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="text-3xl">📄</div>
                        <h2 class="text-xl font-bold text-blue-700 dark:text-blue-300">Calificaciones</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Consulta todas las calificaciones por alumno y examen.</p>
                </a>

                {{-- Promedios --}}
                <a href="{{ route('docente.reportes.promedios') }}"
                   class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border-l-8 border-emerald-500 hover:scale-[1.02] transition">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="text-3xl">📈</div>
                        <h2 class="text-xl font-bold text-emerald-700 dark:text-emerald-300">Promedios</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Revisa los promedios por materia o evaluación.</p>
                </a>

                {{-- Preguntas por Examen --}}
                <a href="{{ route('docente.reportes.preguntas') }}"
                   class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border-l-8 border-purple-500 hover:scale-[1.02] transition">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="text-3xl">🧠</div>
                        <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300">Preguntas por Examen</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Analiza la cantidad y distribución de preguntas.</p>
                </a>

                {{-- Estudiantes por Curso --}}
                <a href="{{ route('docente.reportes.estudiantes') }}"
                   class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border-l-8 border-pink-500 hover:scale-[1.02] transition">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="text-3xl">👥</div>
                        <h2 class="text-xl font-bold text-pink-700 dark:text-pink-300">Estudiantes</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Consulta qué alumnos hay en cada grupo y su rendimiento.</p>
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
