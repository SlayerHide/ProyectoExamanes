<x-layouts.app title="Crear Examen">
    <div class="p-6 max-w-5xl mx-auto bg-white dark:bg-gray-900 rounded shadow text-black">
        <h1 class="text-2xl font-bold mb-4">Crear nuevo examen</h1>

        @if(session('status'))
            <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('docente.examenes.guardar') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1">Título:</label>
                <input type="text" name="titulo" class="w-full border rounded p-2 text-black" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Descripción:</label>
                <textarea name="descripcion" class="w-full border rounded p-2 text-black"></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Duración (minutos):</label>
                <input type="number" name="duracion" class="w-full border rounded p-2 text-black" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Grupo Materia ID:</label>
                <input type="number" name="grupo_materia_id" class="w-full border rounded p-2 text-black" required>
            </div>

            <div id="preguntas-container">
                <h2 class="text-xl font-bold mt-6 mb-2">Preguntas</h2>

                <div class="pregunta border p-4 rounded mb-4" data-index="0">
                    <input type="hidden" name="preguntas[0][tipo]" value="opcion_multiple">

                    <label class="block font-semibold mb-1">Contenido:</label>
                    <input type="text" name="preguntas[0][contenido]" class="w-full border p-2 mb-2 text-black" required>

                    <label class="block font-semibold mb-1">Porcentaje:</label>
                    <input type="number" name="preguntas[0][porcentaje]" class="w-full border p-2 mb-2 text-black" required>

                    <label class="block font-semibold mb-1">Retroalimentación:</label>
                    <input type="text" name="preguntas[0][retroalimentacion]" class="w-full border p-2 mb-2 text-black">

                    <label class="block font-semibold mb-1">Opciones:</label>
                    <div class="mb-2">
                        <input type="text" name="preguntas[0][opciones][0][texto]" placeholder="Texto opción 1" class="w-full border p-2 text-black">
                        <label class="inline-flex items-center mt-1 text-black">
                            <input type="checkbox" name="preguntas[0][opciones][0][es_correcta]" class="mr-2"> Correcta
                        </label>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="preguntas[0][opciones][1][texto]" placeholder="Texto opción 2" class="w-full border p-2 text-black">
                        <label class="inline-flex items-center mt-1 text-black">
                            <input type="checkbox" name="preguntas[0][opciones][1][es_correcta]" class="mr-2"> Correcta
                        </label>
                    </div>
                </div>
            </div>

            <button type="button" id="btn-agregar-pregunta" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition mb-4">
    + Agregar otra pregunta
</button>


            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded mt-4 hover:bg-purple-700 transition">
                Guardar Examen
            </button>
        </form>
    </div>
    <script src="{{ asset('js/crearExamen.js') }}"></script>

</x-layouts.app>
