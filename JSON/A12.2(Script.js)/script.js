// Escucha el evento 'DOMContentLoaded', que se dispara cuando el DOM está completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Realiza una solicitud fetch para obtener los datos del archivo 'data.json'
    fetch('data.json')
    .then(response => response.json()) // Convierte la respuesta en formato JSON
    .then(data => {
        // Busca el contenedor en el DOM donde se mostrarán los datos
        const container = document.getElementById('data-container');
        // Itera sobre cada item en la propiedad 'items' del JSON
        data.items.forEach(item => {
            // Crea un nuevo div para cada item
            const div = document.createElement('div');
            // Asigna el texto del div para mostrar el nombre y la edad del item
            div.textContent = `Nombre: ${item.name}, Edad: ${item.age}, Apellidos: ${item.apellido}`;
            // Agrega el div al contenedor
            container.appendChild(div);
        });
    })
    .catch(error => console.error('Error:', error)); // Captura y muestra cualquier error que ocurra durante la solicitud fetch o el procesamiento de los datos
});