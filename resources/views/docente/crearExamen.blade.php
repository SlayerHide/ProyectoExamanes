<x-layouts.app title="Crear Examen">
    <div class="p-8 max-w-5xl mx-auto min-h-screen bg-gradient-to-br from-indigo-100 to-purple-200 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-xl text-gray-800 dark:text-white">
        <h1 class="text-4xl font-extrabold text-center text-purple-800 dark:text-purple-300 mb-10">✍️ Crear nuevo examen</h1>

        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-300 text-red-800 p-4 rounded-lg">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>⚠ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('docente.examenes.guardar') }}" id="form-examen" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1">📘 Título del Examen:</label>
                    <input type="text" name="titulo" required maxlength="255"
                           class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-black dark:text-white shadow-sm focus:ring-2 focus:ring-purple-400">
                </div>

                <div>
                    <label class="block font-semibold mb-1">⏱ Duración (minutos):</label>
                    <input type="number" name="duracion" required min="1"
                           class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-black dark:text-white shadow-sm focus:ring-2 focus:ring-purple-400">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">📝 Descripción:</label>
                <textarea name="descripcion" rows="3" maxlength="500" required
                          class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-black dark:text-white shadow-sm focus:ring-2 focus:ring-purple-400"></textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">🏫 Grupo - Materia:</label>
                <select name="grupo_materia_id" required
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white text-black shadow-sm focus:ring-2 focus:ring-purple-400">
                    <option value="">Seleccione una opción</option>
                    @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }} - {{ $grupo->materia }}</option>
                    @endforeach
                </select>
            </div>

            <div id="preguntas-container">
                <h2 class="text-2xl font-bold text-purple-800 dark:text-purple-300 mt-10 mb-4">📚 Preguntas</h2>

                <div class="pregunta bg-white dark:bg-gray-800 border border-purple-300 dark:border-purple-700 p-6 rounded-xl shadow-md space-y-4 mb-6" data-index="0">
                    <input type="hidden" name="preguntas[0][tipo]" value="opcion_multiple">

                    <div>
                        <label class="block font-semibold mb-1">Pregunta:</label>
                        <input type="text" name="preguntas[0][contenido]" required maxlength="500"
                               class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Porcentaje:</label>
                        <input type="number" name="preguntas[0][porcentaje]" required min="0" max="100"
                               class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Retroalimentación:</label>
                        <input type="text" name="preguntas[0][retroalimentacion]" required maxlength="500"
                               class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Opciones:</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 opciones">
                            <div class = "opcion">
                                <input type="text" name="preguntas[0][opciones][0][texto]" placeholder="Opción 1" required
                                       class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                                <label class="inline-flex items-center mt-2 text-sm">
                                    <input type="checkbox" name="preguntas[0][opciones][0][es_correcta]" class="mr-2"> Correcta
                                </label>
                            </div>
                            <div class = "opcion">
                                <input type="text" name="preguntas[0][opciones][1][texto]" placeholder="Opción 2" required
                                       class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                                <label class="inline-flex items-center mt-2 text-sm">
                                    <input type="checkbox" name="preguntas[0][opciones][1][es_correcta]" class="mr-2"> Correcta
                                </label>
                            </div>
                        </div>
                        <button type="button" class="btn-agregar-opcion mt-4 text-blue-600 hover:underline text-sm" data-index="0">
                            ➕ Agregar otra opción
                        </button>
                        <button type="button" class="btn-eliminar-opcion text-red-500 hover:text-red-700 text-sm" title="Eliminar opción">
                            🗑️ Eliminar opcion</button>

                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-8">
                <button type="button" id="btn-agregar-pregunta"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-5 py-2 rounded shadow transition">
                    ➕ Agregar pregunta
                </button>

                <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded shadow transition">
                    ✅ Guardar Examen
                </button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/crearExamen.js') }}"></script>
</x-layouts.app>
