document.addEventListener("DOMContentLoaded", function () {
    let preguntaIndex = 1;

    // Agregar nueva pregunta
    const btnAgregarPregunta = document.getElementById("btn-agregar-pregunta");
    const contenedor = document.getElementById("preguntas-container");

    btnAgregarPregunta.addEventListener("click", () => {
        const nuevaPregunta = crearBloquePregunta(preguntaIndex);
        contenedor.appendChild(nuevaPregunta);
        preguntaIndex++;
    });

    function crearBloquePregunta(index) {
        const div = document.createElement("div");
        div.className = "pregunta bg-white dark:bg-gray-800 border border-purple-300 dark:border-purple-700 p-6 rounded-xl shadow-md space-y-4 mb-6";
        div.setAttribute("data-index", index);

        div.innerHTML = `
            <input type="hidden" name="preguntas[${index}][tipo]" value="opcion_multiple">
            <div>
                <label class="block font-semibold mb-1">Pregunta:</label>
                <input type="text" name="preguntas[${index}][contenido]" required maxlength="500"
                    class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
            </div>

            <div>
                <label class="block font-semibold mb-1">Porcentaje:</label>
                <input type="number" name="preguntas[${index}][porcentaje]" required min="0" max="100"
                    class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
            </div>

            <div>
                <label class="block font-semibold mb-1">Retroalimentación:</label>
                <input type="text" name="preguntas[${index}][retroalimentacion]" required maxlength="500"
                    class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
            </div>

            <div>
                <label class="block font-semibold mb-1">Opciones:</label>
                <div class="opciones grid grid-cols-1 md:grid-cols-2 gap-4">
                    ${crearOpcionHTML(index, 0)}
                    ${crearOpcionHTML(index, 1)}
                </div>
                <div class="mt-4 flex gap-4">
                    <button type="button" class="btn-agregar-opcion text-blue-600 hover:underline text-sm" data-index="${index}">
                        ➕ Agregar otra opción
                    </button>
                    <button type="button" class="btn-eliminar-opcion text-red-500 hover:text-red-700 text-sm" data-index="${index}">
                        🗑️ Eliminar última opción
                    </button>
                </div>
            </div>
        `;

        return div;
    }

    function crearOpcionHTML(preguntaIndex, opcionIndex) {
        return `
            <div>
                <input type="text" name="preguntas[${preguntaIndex}][opciones][${opcionIndex}][texto]" required placeholder="Texto opción"
                    class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                <label class="inline-flex items-center mt-2 text-sm">
                    <input type="checkbox" name="preguntas[${preguntaIndex}][opciones][${opcionIndex}][es_correcta]" class="mr-2">
                    Correcta
                </label>
            </div>
        `;
    }

    // Delegación para agregar/eliminar opciones dinámicamente
    contenedor.addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-agregar-opcion")) {
            const preguntaDiv = e.target.closest(".pregunta");
            const index = preguntaDiv.getAttribute("data-index");
            const opcionesContenedor = preguntaDiv.querySelector(".opciones");
            const nuevaIndex = opcionesContenedor.children.length;
            opcionesContenedor.insertAdjacentHTML("beforeend", crearOpcionHTML(index, nuevaIndex));
        }

        if (e.target.classList.contains("btn-eliminar-opcion")) {
            const preguntaDiv = e.target.closest(".pregunta");
            const opcionesContenedor = preguntaDiv.querySelector(".opciones");

            if (opcionesContenedor.children.length > 2) {
                opcionesContenedor.lastElementChild.remove();
            } else {
                alert("Debe haber al menos 2 opciones por pregunta.");
            }
        }
    });
});
