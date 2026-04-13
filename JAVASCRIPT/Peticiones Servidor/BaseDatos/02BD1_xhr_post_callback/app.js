// Hace la petición AJAX POST
function buscarAlumnos(puntuacion, onSuccess, onError) {
  const xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status >= 200 && xhr.status < 300) {
        const datos = JSON.parse(xhr.responseText);
        onSuccess(datos, puntuacion);
      } else {
        if (typeof onError === "function") {
          onError(xhr.status);
        }
      }
    }
  };

  // Abrir petición POST (sin parámetros en la URL)
  xhr.open("POST", "buscar_alumnos.php", true);
  
  // Establecer header obligatorio para POST form-urlencoded
  xhr.setRequestHeader(
    "Content-Type", 
    "application/x-www-form-urlencoded;charset=UTF-8"
  );

  // Enviar la puntuación en el body como "puntuacion=valor"
  xhr.send("puntuacion=" + encodeURIComponent(puntuacion));
}

// Callback de éxito (igual que antes)
function manejarRespuestaCorrecta(datos, puntuacionUsada) {
  const salida = document.getElementById("resultado");

  if (!Array.isArray(datos) || datos.length === 0) {
    salida.innerHTML =
      "No hay alumnos con puntuación mayor que " + puntuacionUsada + ".";
    return;
  }

  let html = "<ul>";
  for (let i = 0; i < datos.length; i++) {
    html +=
      "<li>" +
      datos[i].alumno +
      " - " +
      datos[i].puntuacion +
      "</li>";
  }
  html += "</ul>";

  salida.innerHTML = html;
}

// Callback de error (igual que antes)
function manejarError(status) {
  const salida = document.getElementById("resultado");
  salida.innerHTML = "Error en la petición: " + status;
}

// Manejador del click del botón
function manejarClickBuscar() {
  const input = document.getElementById("puntuacion");
  const salida = document.getElementById("resultado");
  const puntuacion = input.value;

  salida.innerHTML = "";

  if (puntuacion === "") {
    salida.innerHTML = "Introduce una puntuación.";
    return;
  }

  buscarAlumnos(puntuacion, manejarRespuestaCorrecta, manejarError);
}

// Registrar eventos cuando el DOM está cargado
function inicializarEventos() {
  const boton = document.getElementById("btnBuscar");
  if (boton) {
    boton.addEventListener("click", manejarClickBuscar);
  }
}

document.addEventListener("DOMContentLoaded", inicializarEventos);
