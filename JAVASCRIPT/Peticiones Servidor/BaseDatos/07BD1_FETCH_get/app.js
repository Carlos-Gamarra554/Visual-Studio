document.addEventListener("DOMContentLoaded", () => {
    const btnBuscar = document.getElementById("btnBuscar");
    btnBuscar.addEventListener("click", manejarClickBuscar);
});

function manejarClickBuscar() {
    const input = document.getElementById("puntuacion");
    const divResultado = document.getElementById("resultado");
    const valor = input.value.trim();

    // Limpiar resultados previos
    divResultado.innerHTML = "";

    // Validación
    if (valor === "") {
        divResultado.textContent = "Por favor, introduce una puntuación.";
        return;
    }

    // Llamada a la función que hace la petición
    buscarAlumnos(valor, manejarRespuestaCorrecta, manejarError);
}

/**
 * Realiza la petición fetch sin async/await
 */
function buscarAlumnos(puntuacion, callbackExito, callbackError) {

    fetch("buscar_alumnos.php?puntuacion=" + encodeURIComponent(puntuacion))
        .then(response => {
            if (!response.ok) {
                // Error HTTP
                callbackError("Error HTTP: " + response.status);
                return null; 
            }
            return response.json();
        })
        .then(datos => {
            if (datos !== null) {   // Evitar ejecutar si ya se manejó un error
                callbackExito(datos);
            }
        })
        .catch(error => {
            callbackError("Error de red o conexión: " + error.message);
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
