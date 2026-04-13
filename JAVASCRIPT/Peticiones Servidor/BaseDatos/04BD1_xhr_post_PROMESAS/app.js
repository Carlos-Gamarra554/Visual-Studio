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

        // Llamamos a la función que hace POST y devuelve una promesa
        buscarAlumnosPOST(puntuacion)
            .then(alumnos => manejarRespuestaCorrecta(alumnos))
            .catch(error  => manejarError(error));
    });


    // ==============================================================
    // Función que realiza la petición con método POST y devuelve una Promesa
    // ==============================================================
    function buscarAlumnosPOST(puntuacion) {
        const url = "buscar_alumnos.php";

        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();

            xhr.open("POST", url, true);
            xhr.timeout = 10000;

            // Importante: indicamos que enviamos datos tipo formulario
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        const datos = JSON.parse(xhr.responseText);
                        resolve(datos);
                    } catch (e) {
                        reject(new Error("El servidor no devolvió JSON válido"));
                    }
                } else {
                    reject(new Error(`Error HTTP ${xhr.status}: ${xhr.statusText}`));
                }
            };

            xhr.onerror = () => reject(new Error("Error de red o CORS"));
            xhr.ontimeout = () => reject(new Error("Timeout: el servidor no respondió"));

            // Enviamos el dato en el cuerpo: puntuacion=150
            const datos = `puntuacion=${encodeURIComponent(puntuacion)}`;
            xhr.send(datos);
        });
    }


    // ==============================================================
    // Callback éxito
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
    // Callback error
    // ==============================================================
    function manejarError(error) {
        const mensaje = error.message || "Error desconocido";
        divResultado.innerHTML = `<p style="color:red; font-weight:bold;">Error: ${mensaje}</p>`;
    }

});