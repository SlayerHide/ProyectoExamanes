<x-layouts.app title="Crear Examen">
    <div class="p-6 max-w-5xl mx-auto bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Crear nuevo examen</h1>

        <form method="POST" action="{{ route('docente.examenes.guardar') }}">
            @csrf

            <div class="mb-4">
                <label class="font-semibold">Título:</label>
                <input type="text" name="titulo" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Descripción:</label>
                <textarea name="descripcion" class="w-full border rounded p-2"></textarea>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Duración (minutos):</label>
                <input type="number" name="duracion" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Grupo Materia ID:</label>
                <input type="number" name="grupo_materia_id" class="w-full border rounded p-2" required>
            </div>

            <div id="preguntas-container">
                <h2 class="text-xl font-bold mt-6 mb-2">Preguntas</h2>

                <div class="pregunta border p-4 rounded mb-4" data-index="0">
                    <input type="hidden" name="preguntas[0][tipo]" value="opcion_multiple">
                    <label>Contenido:</label>
                    <input type="text" name="preguntas[0][contenido]" class="w-full border p-2 mb-2" required>

                    <label>Porcentaje:</label>
                    <input type="number" name="preguntas[0][porcentaje]" class="w-full border p-2 mb-2" required>

                    <label>Retroalimentación:</label>
                    <input type="text" name="preguntas[0][retroalimentacion]" class="w-full border p-2 mb-2">

                    <label>Opciones:</label>
                    <div>
                        <input type="text" name="preguntas[0][opciones][0][texto]" placeholder="Texto opción 1" class="w-full border p-2 mb-1">
                        <label><input type="checkbox" name="preguntas[0][opciones][0][es_correcta]"> Correcta</label>
                    </div>
                    <div>
                        <input type="text" name="preguntas[0][opciones][1][texto]" placeholder="Texto opción 2" class="w-full border p-2 mb-1">
                        <label><input type="checkbox" name="preguntas[0][opciones][1][es_correcta]"> Correcta</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Guardar Examen</button>
        </form>
    </div>
</x-layouts.app>
