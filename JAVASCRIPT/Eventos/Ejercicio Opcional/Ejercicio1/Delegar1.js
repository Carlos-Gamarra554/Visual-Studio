//Seleccionamos la tabla
const tabla = document.querySelector('table');

//Añadimons un gestor de eventos a la tabla
tabla.addEventListener('click', function(event) {
    //Comprobamos si el elemento es "si" y mostramos una alerta si lo es
    if(event.target.tagName === 'TD' && event.target.textContent === 'Sí') {
        alert('Has pulsado la celda ' + event.target.id);
    }
})