// app.js

document.addEventListener("DOMContentLoaded", function () {

    const inputPuntuacion = document.getElementById("puntuacion");
    const btnBuscar       = document.getElementById("btnBuscar");
    const divResultado    = document.getElementById("resultado");

    btnBuscar.addEventListener("click", function () {
        divResultado.innerHTML = "";

        const valor = inputPuntuacion.value.trim();

        if (valor === "") {
            divResultado.innerHTML = '<p style="color:#e67e22;">Por favor, introduce una puntuación.</p>';
            return;
        }

        const puntuacion = parseInt(valor, 10);
        if (isNaN(puntuacion) || puntuacion < 0) {
            divResultado.innerHTML = '<p style="color:#e67e22;">Debe ser un número entero positivo.</p>';
            return;
        }

        // Ahora usamos la promesa que devuelve buscarAlumnos()
        buscarAlumnos(puntuacion)
            .then(alumnos => manejarRespuestaCorrecta(alumnos))
            .catch(error   => manejarError(error));
    });


    // ==============================================================
    // Función que devuelve directamente una Promesa
    // ==============================================================
    function buscarAlumnos(puntuacion) {
        const url = `buscar_alumnos.php?puntuacion=${encodeURIComponent(puntuacion)}`;

        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();

            xhr.open("GET", url, true);
            xhr.timeout = 10000; // 10 segundos

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        const datos = JSON.parse(xhr.responseText);
                        resolve(datos); // array de alumnos
                    } catch (e) {
                        reject(new Error("La respuesta del servidor no es un JSON válido"));
                    }
                } else {
                    reject(new Error(`Error HTTP ${xhr.status}: ${xhr.statusText}`));
                }
            };

            xhr.onerror = function () {
                reject(new Error("Error de red (posiblemente sin conexión o CORS)"));
            };

            xhr.ontimeout = function () {
                reject(new Error("Timeout: el servidor tardó demasiado en responder"));
            };

            xhr.send();
        });
    }


    // ==============================================================
    // Callback de éxito – función separada
    // ==============================================================
    function manejarRespuestaCorrecta(alumnos) {
        if (!Array.isArray(alumnos) || alumnos.length === 0) {
            divResultado.innerHTML = `
                <p>No hay alumnos con puntuación estrictamente mayor a <strong>${inputPuntuacion.value}</strong>.</p>
            `;
            return;
        }

        let lista = "<ul style='line-height:1.8;'>";
        alumnos.forEach(al => {
            lista += `<li><strong>${al.alumno}</strong> → ${al.puntuacion} puntos</li>`;
        });
        lista += "</ul>";

        divResultado.innerHTML = `
            <p>Se encontraron <strong>${alumnos.length}</strong> alumno(s):</p>
            ${lista}
        `;
    }


    // ==============================================================
    // Callback de error – función separada
    // ==============================================================
    function manejarError(error) {
        let mensaje = error.message || "Error desconocido";

        divResultado.innerHTML = `<p style="color:red; font-weight:bold;">Error: ${mensaje}</p>`;
    }

});