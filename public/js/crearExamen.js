document.addEventListener('DOMContentLoaded', () => {
    let preguntasContainer = document.getElementById('preguntas-container');
    let preguntaIndex = 1;

    document.getElementById('btn-agregar-pregunta').addEventListener('click', () => {
        let nuevaPregunta = document.createElement('div');
        nuevaPregunta.classList.add('pregunta', 'border', 'p-4', 'rounded', 'mb-4');
        nuevaPregunta.innerHTML = `
            <input type="hidden" name="preguntas[${preguntaIndex}][tipo]" value="opcion_multiple">

            <label>Contenido:</label>
            <input type="text" name="preguntas[${preguntaIndex}][contenido]" class="w-full border p-2 mb-2 text-black" required>

            <label>Porcentaje:</label>
            <input type="number" name="preguntas[${preguntaIndex}][porcentaje]" class="w-full border p-2 mb-2 text-black" required>

            <label>Retroalimentación:</label>
            <input type="text" name="preguntas[${preguntaIndex}][retroalimentacion]" class="w-full border p-2 mb-2 text-black">

            <div class="opciones-container">
                <label>Opciones:</label>
                <div class="mb-2">
                    <input type="text" name="preguntas[${preguntaIndex}][opciones][0][texto]" class="w-full border p-2 text-black">
                    <label><input type="checkbox" name="preguntas[${preguntaIndex}][opciones][0][es_correcta]"> Correcta</label>
                </div>
            </div>

            <button type="button" class="btn-agregar-opcion bg-green-600 text-white px-2 py-1 rounded mt-2">+ Opción</button>
        `;

        preguntasContainer.appendChild(nuevaPregunta);

        // Agregar opción dentro de la nueva pregunta
        nuevaPregunta.querySelector('.btn-agregar-opcion').addEventListener('click', function () {
            let opcionesContainer = nuevaPregunta.querySelector('.opciones-container');
            let opcionCount = opcionesContainer.querySelectorAll('input[type="text"]').length;
            let opcionHTML = `
                <div class="mb-2">
                    <input type="text" name="preguntas[${preguntaIndex}][opciones][${opcionCount}][texto]" class="w-full border p-2 text-black">
                    <label><input type="checkbox" name="preguntas[${preguntaIndex}][opciones][${opcionCount}][es_correcta]"> Correcta</label>
                </div>
            `;
            opcionesContainer.insertAdjacentHTML('beforeend', opcionHTML);
        });

        preguntaIndex++;
    });
});
