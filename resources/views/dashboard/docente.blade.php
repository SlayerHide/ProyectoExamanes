<x-layouts.app title="Dashboard del Docente">
    <div class="p-8 min-h-screen bg-gradient-to-br from-indigo-100 to-purple-200 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-6xl mx-auto text-center mb-12">
            <h1 class="text-4xl font-extrabold text-purple-800 dark:text-purple-300 mb-2">Bienvenido, {{ Auth::user()->name }}</h1>
            <p class="text-gray-700 dark:text-gray-400 text-lg">Este es tu panel de control como Docente.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            
            {{-- Crear Examen --}}
            <a href="{{ route('docente.examenes.crear') }}"
               class="bg-white dark:bg-gray-900 border border-purple-300 dark:border-purple-700 p-6 rounded-2xl shadow-md hover:shadow-lg transform hover:-translate-y-1 transition">
                <div class="flex flex-col gap-2">
                    <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300">📝 Crear Examen</h2>
                    <p class="text-gray-600 dark:text-gray-400">Diseña nuevos exámenes para tus grupos.</p>
                </div>
            </a>

            {{-- Ver Resultados --}}
            <a href="{{ route('docente.resultados') }}"
               class="bg-white dark:bg-gray-900 border border-purple-300 dark:border-purple-700 p-6 rounded-2xl shadow-md hover:shadow-lg transform hover:-translate-y-1 transition">
                <div class="flex flex-col gap-2">
                    <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300">📊 Resultados</h2>
                    <p class="text-gray-600 dark:text-gray-400">Visualiza los resultados de tus exámenes.</p>
                </div>
            </a>

            {{-- Reportes --}}
            <a href="{{ route('docente.reportes.index') }}"
               class="bg-white dark:bg-gray-900 border border-purple-300 dark:border-purple-700 p-6 rounded-2xl shadow-md hover:shadow-lg transform hover:-translate-y-1 transition">
                <div class="flex flex-col gap-2">
                    <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300">📈 Reportes</h2>
                    <p class="text-gray-600 dark:text-gray-400">Visualiza los reportes de desempeño por grupo y alumno.</p>
                </div>
            </a>

            {{-- Ver Materias --}}
            <a href="{{ route('docente.materias') }}"
               class="bg-white dark:bg-gray-900 border border-purple-300 dark:border-purple-700 p-6 rounded-2xl shadow-md hover:shadow-lg transform hover:-translate-y-1 transition">
                <div class="flex flex-col gap-2">
                    <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300">📚 Mis Materias</h2>
                    <p class="text-gray-600 dark:text-gray-400">Consulta los grupos y materias a tu cargo.</p>
                </div>
            </a>

            <a href="{{ route('docente.materias') }}"
               class="bg-white dark:bg-gray-900 border border-purple-300 dark:border-purple-700 p-6 rounded-2xl shadow-md hover:shadow-lg transform hover:-translate-y-1 transition">
                <div class="flex flex-col gap-2">
                    <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300">Nuevo</h2>
                    <p class="text-gray-600 dark:text-gray-400">Consulta los grupos y materias a tu cargo.</p>
                </div>
            </a>


        </div>
    </div>
</x-layouts.app>
