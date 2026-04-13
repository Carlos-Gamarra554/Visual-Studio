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

    // Llamada a fetch POST usando promesas
    buscarAlumnosPOST(valor)
        .then(lista => manejarRespuestaCorrecta(lista))
        .catch(error => manejarError(error));
}

/**
 * Función que hace la petición POST con fetch y promesas
 */
function buscarAlumnosPOST(puntuacion) {
    return fetch("buscar_alumnos.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "puntuacion=" + encodeURIComponent(puntuacion)
    })
    .then(response => {
        if (!response.ok) {
            // Error HTTP
            return Promise.reject("Error HTTP: " + response.status);
        }
        return response.json();
    })
    .catch(error => {
        // Captura errores de red o HTTP
        return Promise.reject("Error de red o conexión: " + error);
    });
}

/**
 * Callback de éxito
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
 * Callback de error
 */
function manejarError(mensaje) {
    const divResultado = document.getElementById("resultado");
    divResultado.textContent = mensaje;
}
