<x-layouts.app>
    <div class="min-h-screen p-8 bg-gradient-to-tr from-purple-100 to-indigo-200 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-6xl mx-auto">
            
            @if (session('status'))
                <div class="mb-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded shadow">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Encabezado -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-purple-800 dark:text-purple-300">🎓 Bienvenido, {{ Auth::user()->name }}</h1>
                <p class="text-lg text-gray-700 dark:text-gray-300 mt-2">
                    Este es tu panel de control como alumno. Desde aquí puedes consultar exámenes disponibles y tu historial.
                </p>
            </div>

            <!-- Opciones -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <!-- Hacer Examen -->
                <a href="{{ route('alumno.examenes.disponibles') }}"
                   class="bg-white dark:bg-gray-900 border-l-8 border-indigo-500 p-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="text-4xl">📝</div>
                        <h2 class="text-xl font-bold text-indigo-700 dark:text-indigo-300">Hacer Examen</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Revisa y contesta los exámenes asignados a tu grupo.</p>
                </a>

                <!-- Historial -->
                <a href="{{ route('alumno.historial') }}"
                   class="bg-white dark:bg-gray-900 border-l-8 border-purple-500 p-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="text-4xl">📊</div>
                        <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300">Historial de Exámenes</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Consulta tus calificaciones y exámenes realizados.</p>
                </a>


            </div>
        </div>
    </div>
</x-layouts.app>
