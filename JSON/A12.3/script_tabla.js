// Escucha el evento 'DOMContentLoaded', que se dispara cuando el DOM está completamente cargado
document.addEventListener('DOMContentLoaded', function() {

    // Realiza una solicitud fetch para obtener los datos del archivo 'data.json'
    fetch('editorial.json')
    .then(response => response.json())
    .then(editorial => {
        const container = document.getElementById('data-container');

        // Crear la tabla y sus elementos
        const table = document.createElement('table');
        const thead = document.createElement('thead');
        const tbody = document.createElement('tbody');

        // Crear la fila de encabezado
        const headerRow = document.createElement('tr');
        const headers = ['Id', 'Nombre', 'Dirección','Teléfono'];
        headers.forEach(headerText => {
            const th = document.createElement('th');
            th.textContent = headerText;
            headerRow.appendChild(th);
        });
        thead.appendChild(headerRow);
        table.appendChild(thead);

        // Crear las filas de datos
        editorial.editorials.forEach(editorials => {
            const row = document.createElement('tr');

            const idCell = document.createElement('td');
            idCell.textContent = editorials.id;
            row.appendChild(idCell);
            idCell.id="id";

            const nameCell = document.createElement('td');
            nameCell.textContent = editorials.nombre;   
            row.appendChild(nameCell);

            const addressCell = document.createElement('td');
            addressCell.textContent = editorials.direccion;
            row.appendChild(addressCell);

            const telCell = document.createElement('td');
            telCell.textContent = editorials.telefono;
            row.appendChild(telCell);
            telCell.id="tel";

            tbody.appendChild(row);
        });

        table.appendChild(tbody);
        container.appendChild(table);
    })
    .catch(error => console.error('Error:', error));
});