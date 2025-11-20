const celdas = document.querySelectorAll("td");

//Añadimos eventos a cada celda
celdas.forEach(celda => {
    celda.addEventListener("click", () => {
        moverCelda(celda);
    })
});

// Función para comprobar que se puede realizar el movimiento
function moverCelda(celda) {
    const celdaVacia = document.getElementById('vacia');

    if (celda === celdaVacia) return;

    //Obtenemos coordenadas de la celda clicada
    const filaCelda = celda.parentElement.rowIndex;
    const colCelda = celda.cellIndex;
    
    //Obtenemos coordenadas de la celda vacía
    const filaVacia = celdaVacia.parentElement.rowIndex;
    const colVacia = celdaVacia.cellIndex;

    //Calculamos la diferencia de filas y columnas para ver si son adyacentes
    const difFIla = Math.abs(filaCelda - filaVacia);
    const difCol = Math.abs(colCelda - colVacia);

    //Si hay celda a la que moverse, se efectua el movimiento
    if (difFIla + difCol === 1) {
        intercambiarCeldas(celda, celdaVacia);        
    }
}

//Función para intercambiar la celda vacía por la clicada
function intercambiarCeldas(celda1, celda2) {
    const contenidoCelda1 = celda1.innerHTML;

    celda1.innerHTML = celda2.innerHTML;
    celda2.innerHTML = contenidoCelda1;

    celda2.removeAttribute("id");
    celda1.setAttribute("id", "vacia");
}