<x-layouts.app title="Dashboard del Docente">
    <div class="p-6 bg-purple-100 min-h-screen">
        <h1 class="text-3xl font-bold text-purple-800 mb-4">Bienvenido, {{ Auth::user()->name }}</h1>
        <p class="text-gray-700 mb-8">Este es tu panel de control como Docente.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Crear Examen --}}
            <a href="{{ route('docente.examenes.crear') }}" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-105">
                <h2 class="text-xl font-bold text-purple-700 mb-2">Crear Examen</h2>
                <p class="text-gray-600 dark:text-gray-300">Diseña nuevos exámenes para tus grupos.</p>
            </a>

            
            <a href="{{ route('docente.resultados')}}" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-105">
                <h2 class="text-xl font-bold text-purple-700 mb-2">Resultados</h2>
                <p class="text-gray-600 dark:text-gray-300">Visualisa los resultados de tus examenes</p>
            </a>
        </div>
    </div>
</x-layouts.app>
