document.addEventListener("DOMContentLoaded", function () {
    let preguntaIndex = 1;

    // Agregar una nueva pregunta
    document.getElementById("btn-agregar-pregunta").addEventListener("click", function () {
        const preguntasContainer = document.getElementById("preguntas-container");
        const nuevaPregunta = preguntasContainer.querySelector(".pregunta").cloneNode(true);

        // Limpiar valores del clon
        nuevaPregunta.setAttribute("data-index", preguntaIndex);
        nuevaPregunta.querySelectorAll("input, textarea").forEach(el => {
            if (el.type === "checkbox") {
                el.checked = false;
            } else {
                el.value = "";
            }
        });

        // Actualizar los nombres de campos del clon
        actualizarNombres(nuevaPregunta, preguntaIndex);

        preguntasContainer.appendChild(nuevaPregunta);
        preguntaIndex++;
    });

    // Delegar eventos de agregar/eliminar opción
    document.getElementById("preguntas-container").addEventListener("click", function (e) {
        const pregunta = e.target.closest(".pregunta");

        if (e.target.classList.contains("btn-agregar-opcion")) {
            const opcionesContainer = pregunta.querySelector(".opciones");
            const indexPregunta = pregunta.getAttribute("data-index");
            const nuevaOpcion = opcionesContainer.querySelector("div").cloneNode(true);

            const nuevaIndex = opcionesContainer.children.length;

            // Limpiar valores
            nuevaOpcion.querySelector("input[type='text']").value = "";
            nuevaOpcion.querySelector("input[type='checkbox']").checked = false;

            // Actualizar atributos
            const textoInput = nuevaOpcion.querySelector("input[type='text']");
            textoInput.name = `preguntas[${indexPregunta}][opciones][${nuevaIndex}][texto]`;
            textoInput.placeholder = `Opción ${nuevaIndex + 1}`;

            const checkbox = nuevaOpcion.querySelector("input[type='checkbox']");
            checkbox.name = `preguntas[${indexPregunta}][opciones][${nuevaIndex}][es_correcta]`;

            opcionesContainer.appendChild(nuevaOpcion);
        }

        if (e.target.classList.contains("btn-eliminar-opcion")) {
            const opcionesContainer = pregunta.querySelector(".opciones");
            if (opcionesContainer.children.length > 2) {
                opcionesContainer.removeChild(opcionesContainer.lastElementChild);
            } else {
                alert("Debe haber al menos 2 opciones por pregunta.");
            }
        }
    });

    function actualizarNombres(preguntaElement, index) {
        preguntaElement.querySelectorAll("[name]").forEach(el => {
            if (el.name.includes("contenido")) {
                el.name = `preguntas[${index}][contenido]`;
            }
            if (el.name.includes("porcentaje")) {
                el.name = `preguntas[${index}][porcentaje]`;
            }
            if (el.name.includes("retroalimentacion")) {
                el.name = `preguntas[${index}][retroalimentacion]`;
            }
            if (el.name.includes("tipo")) {
                el.name = `preguntas[${index}][tipo]`;
            }
        });

        // Reasignar nombres de opciones
        const opciones = preguntaElement.querySelectorAll(".opciones > div");
        opciones.forEach((op, i) => {
            const texto = op.querySelector("input[type='text']");
            const check = op.querySelector("input[type='checkbox']");
            texto.name = `preguntas[${index}][opciones][${i}][texto]`;
            texto.placeholder = `Opción ${i + 1}`;
            check.name = `preguntas[${index}][opciones][${i}][es_correcta]`;
        });

        // Actualizar botón de opción
        const btnAgregar = preguntaElement.querySelector(".btn-agregar-opcion");
        const btnEliminar = preguntaElement.querySelector(".btn-eliminar-opcion");
        btnAgregar.setAttribute("data-index", index);
        btnEliminar.setAttribute("data-index", index);
    }
});
