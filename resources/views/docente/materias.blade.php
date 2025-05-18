<x-layouts.app title="Mis Materias">
    <div class="min-h-screen p-8 bg-gradient-to-br from-indigo-100 to-purple-200 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl font-extrabold text-purple-800 dark:text-purple-300 mb-10 text-center">📚 Materias Asignadas</h1>

            @if($materias->isEmpty())
                <div class="bg-yellow-100 border-l-4 border-yellow-400 text-yellow-800 p-4 rounded shadow-md text-center">
                    No tienes materias asignadas aún.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($materias as $materia)
                        <div class="bg-white dark:bg-gray-900 border border-purple-300 dark:border-purple-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition">
                            <div class="flex items-center gap-4 mb-3">
                                <div class="text-4xl">📘</div>
                                <div>
                                    <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300">{{ $materia->materia }}</h2>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Grupo: <strong>{{ $materia->nombre }}</strong></p>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                <span class="block">ID de asignación: {{ $materia->id }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
