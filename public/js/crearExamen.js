document.addEventListener("DOMContentLoaded", function () {
    const btnAgregar = document.getElementById("btn-agregar-pregunta");
    const contenedor = document.getElementById("preguntas-container");
    let index = 1;

    // Agregar nueva pregunta
    btnAgregar.addEventListener("click", () => {
        const original = document.querySelector(".pregunta");
        const clon = original.cloneNode(true);

        clon.dataset.index = index;

        clon.querySelectorAll("input, textarea").forEach((el) => {
            if (el.name) {
                el.name = el.name.replace(/\[\d+\]/g, `[${index}]`);
            }
            if (el.type !== "hidden") el.value = "";
            if (el.type === "checkbox") el.checked = false;
        });

        clon.querySelector(".btn-agregar-opcion").dataset.index = index;

        contenedor.appendChild(clon);
        index++;
    });

    // Agregar nueva opción en una pregunta específica
    document.addEventListener("click", function (e) {
        if (e.target && e.target.classList.contains("btn-agregar-opcion")) {
            const pregunta = e.target.closest(".pregunta");
            const idx = pregunta.dataset.index;
            const opcionesContainer = pregunta.querySelector(".opciones");

            const count = opcionesContainer.children.length;
            const nuevaOpcion = document.createElement("div");
            nuevaOpcion.classList.add("mb-2");

            nuevaOpcion.innerHTML = `
                <input type="text" name="preguntas[${idx}][opciones][${count}][texto]" required placeholder="Texto opción ${count + 1}"
                       class="w-full border p-2 bg-white dark:bg-gray-700 text-black dark:text-white">
                <label class="inline-flex items-center mt-1">
                    <input type="checkbox" name="preguntas[${idx}][opciones][${count}][es_correcta]" class="mr-2"> Correcta
                </label>
            `;

            opcionesContainer.appendChild(nuevaOpcion);
        }
    });
});
