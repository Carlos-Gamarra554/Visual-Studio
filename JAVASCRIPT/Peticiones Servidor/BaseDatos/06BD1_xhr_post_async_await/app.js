// app.js

document.addEventListener('DOMContentLoaded', () => {
    const inputPuntuacion = document.getElementById('puntuacion');
    const btnBuscar       = document.getElementById('btnBuscar');
    const divResultado    = document.getElementById('resultado');

    btnBuscar.addEventListener('click', manejarClickBuscar);

    async function manejarClickBuscar() {
        // Limpiar resultado anterior
        divResultado.innerHTML = '';

        const valor = inputPuntuacion.value.trim();

        // Validar que se haya introducido un valor
        if (valor === '' || valor === null || valor === undefined) {
            divResultado.textContent = 'Por favor, introduce una puntuación válida.';
            return;
        }

        const puntuacion = parseInt(valor, 10);

        if (isNaN(puntuacion) || puntuacion < 0) {
            divResultado.textContent = 'La puntuación debe ser un número positivo.';
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
     * Función que realiza la petición AJAX con XMLHttpRequest
     * usando Promesas + async/await
     */
    function buscarAlumnos(puntuacion) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();

            // Usamos POST pero enviamos el parámetro en la query string como pide el enunciado
            xhr.open('POST', `buscar_alumnos.php?puntuacion=${puntuacion}`, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        const data = JSON.parse(xhr.responseText);
                        resolve(data);
                    } catch (e) {
                        reject(new Error('Error al procesar la respuesta JSON'));
                    }
                } else {
                    reject(new Error(`Error del servidor: ${xhr.status} ${xhr.statusText}`));
                }
            };

            xhr.onerror = () => {
                reject(new Error('Error de red al contactar con el servidor'));
            };

            
            xhr.send(`puntuacion=${puntuacion}`);
        });
    }

    /**
     * Callback de éxito: procesa el array de alumnos recibido
     */
    function manejarRespuestaCorrecta(alumnos) {
        if (!Array.isArray(alumnos) || alumnos.length === 0) {
            divResultado.textContent = 'No se encontraron alumnos con puntuación mayor a la indicada.';
            return;
        }

        const ul = document.createElement('ul');

        alumnos.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `${item.alumno} - Puntuación: ${item.puntuacion}`;
            ul.appendChild(li);
        });

        divResultado.appendChild(ul);
    }

    /**
     * Callback de error: muestra mensaje de error
     */
    function manejarError(error) {
        divResultado.style.color = 'red';
        divResultado.textContent = `Error: ${error.message}`;
    }
});