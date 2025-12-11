document.getElementById("cargar").addEventListener("click", function () {

    // Crear la petición AJAX
    var xhr = new XMLHttpRequest();

    // Configurar petición tipo GET a personas.php
    xhr.open("GET", "personas.php", true);

    // Manejar la respuesta
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {          // Petición completada
            if (xhr.status === 200) {       // OK

                // Convertir texto JSON en objeto
                const personas = JSON.parse(xhr.responseText);

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
            } else {
                console.error("Error en la petición AJAX:", xhr.status);
            }
        }
    };


    xhr.onerror = function () {
      console.error("Error de red: no se pudo conectar con el servidor.");
    };

    // Enviar petición
    xhr.send();
});