document.addEventListener("DOMContentLoaded", () => {
    const btnBuscar = document.getElementById("btnBuscar");
    btnBuscar.addEventListener("click", manejarClickBuscar);
});

function manejarClickBuscar() {
    const input = document.getElementById("puntuacion");
    const divResultado = document.getElementById("resultado");
    const valor = input.value.trim();

    divResultado.innerHTML = "";

    if (valor === "") {
        divResultado.textContent = "Por favor, introduce una puntuación.";
        return;
    }

    // Llamamos a la versión async
    buscarAlumnos(valor)
        .then(lista => manejarRespuestaCorrecta(lista))
        .catch(error => manejarError(error));
}

/**
 * Realiza la petición fetch usando async/await
 */
async function buscarAlumnos(puntuacion) {
    const url = "buscar_alumnos.php?puntuacion=" + encodeURIComponent(puntuacion);

    try {
        const response = await fetch(url);

        // Comprobación de errores HTTP
        if (!response.ok) {
            throw new Error("Error HTTP: " + response.status);
        }

        // Convertir JSON (puede lanzar error si el JSON no es válido)
        const datos = await response.json();
        return datos;

    } catch (error) {
        // Aquí capturamos errores de red o problemas con JSON
        throw new Error("Error de red o conexión: " + error.message);
    }
}

/**
 * Manejo de éxito
 */
function manejarRespuestaCorrecta(listaAlumnos) {
    const divResultado = document.getElementById("resultado");

    if (listaAlumnos.length === 0) {
        divResultado.textContent = "No hay alumnos con puntuación mayor que la indicada.";
        return;
    }

    const ul = document.createElement("ul");

    listaAlumnos.forEach(alumno => {
        const li = document.createElement("li");
        li.textContent = `${alumno.alumno} — ${alumno.puntuacion}`;
        ul.appendChild(li);
    });

    divResultado.appendChild(ul);
}

/**
 * Manejo de errores
 */
function manejarError(error) {
    const divResultado = document.getElementById("resultado");
    divResultado.textContent = error.message;
}
