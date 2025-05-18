<x-layouts.app title="Estudiantes por Curso">
    <div class="min-h-screen p-8 bg-gradient-to-tr from-indigo-100 to-purple-200 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl font-extrabold text-purple-800 dark:text-purple-300 mb-10 text-center">
                👨‍🏫 Estudiantes por Curso
            </h1>

            <div class="grid gap-8">
                @foreach ($cursos as $curso)
                    <div class="bg-white dark:bg-gray-900 border-l-8 border-purple-400 dark:border-purple-600 rounded-2xl shadow-lg hover:shadow-xl transition p-6">
                        <h2 class="text-2xl font-bold text-purple-700 dark:text-purple-300 mb-4">
                            📘 {{ $curso->nombre }} — {{ $curso->materia }}
                        </h2>

                        @if ($curso->users->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400 italic">No hay alumnos inscritos en este curso.</p>
                        @else
                            <ul class="divide-y divide-purple-100 dark:divide-purple-800">
                                @foreach ($curso->users as $user)
                                    <li class="py-3 flex flex-col md:flex-row justify-between md:items-center gap-3">
                                        <div>
                                            <p class="text-lg font-semibold text-purple-900 dark:text-purple-100">{{ $user->name }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                                        </div>
                                        <a href="{{ route('docente.reportes.rendimiento', $user->id) }}"
                                           class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                            📊 Ver rendimiento
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
