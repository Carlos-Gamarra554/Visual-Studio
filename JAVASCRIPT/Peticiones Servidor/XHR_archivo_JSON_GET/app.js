document.getElementById("cargar").addEventListener("click", function () {

    const peticion = new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();

        xhr.onload = function() {
            if (xhr.status === 200) {
                const personas = JSON.parse(xhr.responseText);
                resolve(personas);
            } else {
                reject("Error en la petición AJAX:", xhr.status);
            }
        }

        xhr.open("GET", "personas.php", true);

        xhr.onerror = function() {
            reject("Error de red: no se pudo conectar con el servidor.");
        }

        xhr.send();

        peticion
        .then(() => {
            const tbody = document.querySelector("#tabla tbody");
                tbody.innerHTML = ""; // limpiar tabla

                // Rellenar tabla
                personas.forEach(function (p) {
                    const fila = document.createElement("tr");
                    
                    for (const propiedad in p) {
                        const celda = document.createElement("td");
                        const texto = document.createTextNode(p[propiedad]);
                        celda.appendChild(texto);
                        fila.appendChild(celda);
                    }

                    tbody.appendChild(fila);
                });
        })
        .catch(() => {

        });
    });
});