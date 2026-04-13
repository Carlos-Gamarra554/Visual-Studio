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

    buscarAlumnosPOST(valor)
        .then(lista => manejarRespuestaCorrecta(lista))
        .catch(error => manejarError(error));
}

/**
 * Hace una petición POST usando fetch + async/await
 */
async function buscarAlumnosPOST(puntuacion) {
    try {
        const response = await fetch("buscar_alumnos.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "puntuacion=" + encodeURIComponent(puntuacion)
        });

        // Comprobación de errores HTTP
        if (!response.ok) {
            throw new Error("Error HTTP: " + response.status);
        }

        // Convertir JSON
        const datos = await response.json();
        return datos;

    } catch (error) {
        // Captura errores de red, CORS, parseo...
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
