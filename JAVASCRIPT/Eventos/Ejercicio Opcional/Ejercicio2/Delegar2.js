// Seleccionamos todas las celdas que contienen "Sí"
const celdasSi = document.querySelectorAll('td.si');

//Añadimos un gestor de eventos para cada celda "Sí" con for each
celdasSi.forEach(celda => {
    celda.addEventListener('click', function() {
        alert('Has hecho click en el si ' + this.id);
    })
});