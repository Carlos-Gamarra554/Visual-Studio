// app.js

document.addEventListener('DOMContentLoaded', () => {
    const inputPuntuacion = document.getElementById('puntuacion');
    const btnBuscar       = document.getElementById('btnBuscar');
    const divResultado    = document.getElementById1('resultado');

    btnBuscar.addEventListener('click', manejarClickBuscar);

    async function manejarClickBuscar() {
        // Limpiar resultado anterior
        divResultado.innerHTML = '';

        const valor = inputPuntuacion.value.trim();

        // Validar entrada
        if (valor === '' || valor === null || valor === undefined) {
            divResultado.textContent = 'Por favor, introduce una puntuación válida.';
            return;
        }

        const puntuacion = parseInt(valor, 10);

        if (isNaN(puntuacion) || puntuacion < 0) {
            divResultado.textContent = 'La puntuación debe ser un número entero no negativo.';
            return;
        }

        try {
            const alumnos = await buscarAlumnos(puntuacion);
            manejarRespuestaCorrecta(alumnos);
        } catch (error) {
            manejarError(error);
        }
    }

    /**
     * Realiza la petición AJAX usando XMLHttpRequest + GET
     * Devuelve una Promesa que resuelve con el array de alumnos
     */
    function buscarAlumnos(puntuacion) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();

            // Usamos GET y pasamos la puntuación directamente en la URL
            const url = `buscar_alumnos.php?puntuacion=${encodeURIComponent(puntuacion)}`;
            xhr.open('GET', url, true);

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        const data = JSON.parse(xhr.responseText);
                        resolve(data);
                    } catch (e) {
                        reject(new Error('Error al parsear la respuesta JSON'));
                    }
                } else {
                    reject(new Error(`Error del servidor: ${xhr.status} ${xhr.statusText}`));
                }
            };

            xhr.onerror = () => {
                reject(new Error('Error de red: no se pudo contactar con el servidor'));
            };

            // GET no envía cuerpo
            xhr.send();
        });
    }

    /**
     * Callback de éxito: muestra los alumnos encontrados
     */
    function manejarRespuestaCorrecta(alumnos) {
        if (!Array.isArray(alumnos) || alumnos.length === 0) {
            divResultado.textContent = 'No hay alumnos con puntuación estrictamente mayor a la introducida.';
            return;
        }

        const ul = document.createElement('ul');

        alumnos.forEach(alumno => {
            const li = document.createElement('li');
            li.textContent = `${alumno.alumno} - Puntuación: ${alumno.puntuacion}`;
            ul.appendChild(li);
        });

        divResultado.appendChild(ul);
    }

    /**
     * Callback de error: muestra mensaje de error claro
     */
    function manejarError(error) {
        divResultado.style.color = 'red';
        divResultado.innerHTML = `<strong>Error:</strong> ${error.message}`;
    }
});