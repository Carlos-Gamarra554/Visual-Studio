const subir = document.getElementById('subir');
const bajar = document.getElementById('bajar');
const izquierda = document.getElementById('izquierda');
const derecha = document.getElementById('derecha');

//Añadimos los gestores de eventos para los botones
subir.addEventListener('click', () => moverCelda('subir'));
bajar.addEventListener('click', () => moverCelda('bajar'));
izquierda.addEventListener('click', () => moverCelda('izquierda'));
derecha.addEventListener('click', () => moverCelda('derecha'));

// Función para mover la celda vacía en la dirección indicada
function moverCelda(direccion) {
    const celdaVacia = document.getElementById('vacia');
    const filaCeldaVacia = celdaVacia.parentElement;
    const indiceCeldaVacia = celdaVacia.cellIndex;
    let celdaIntercambio = null;

    //Switch para cada dirección a la que pueda moverse según el botón que se pulse
    //Se devuelve la celda a la que se va a intercambiar si se puede mover ahí
    switch (direccion) {
        case 'subir':
            const filaArriba = filaCeldaVacia.previousElementSibling;
            if(filaArriba) {
                celdaIntercambio = filaArriba.cells[indiceCeldaVacia];
            }
            break;

        case 'bajar':
            const filaAbajo = filaCeldaVacia.nextElementSibling;
            if(filaAbajo) {
                celdaIntercambio = filaAbajo.cells[indiceCeldaVacia];
            }
            break;

        case 'izquierda':
            if(indiceCeldaVacia > 0) {
                celdaIntercambio = filaCeldaVacia.cells[indiceCeldaVacia - 1];
            }
            break;

        case 'derecha':
            if(indiceCeldaVacia < 2) {
                celdaIntercambio = filaCeldaVacia.cells[indiceCeldaVacia + 1];
            }
            break;
    }

    //Si hay celda a la que moverse, se efectua el movimiento
    if(celdaIntercambio) {
        celdaVacia.innerHTML = celdaIntercambio.innerHTML;
        celdaIntercambio.innerHTML = '';

        //También se mueve el id de la celda vacía a la nueva celda en blanco
        celdaIntercambio.setAttribute('id', 'vacia');
        celdaVacia.removeAttribute('id');
    }
}