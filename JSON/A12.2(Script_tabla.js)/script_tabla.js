// Escucha el evento 'DOMContentLoaded', que se dispara cuando el DOM está completamente cargado
document.addEventListener('DOMContentLoaded', function() {

    // Realiza una solicitud fetch para obtener los datos del archivo 'data.json'
    fetch('data.json')
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('data-container');

        // Crear la tabla y sus elementos
        const table = document.createElement('table');
        const thead = document.createElement('thead');
        const tbody = document.createElement('tbody');

        // Crear la fila de encabezado
        const headerRow = document.createElement('tr');
        const headers = ['Nombre', 'Edad','Apellidos'];
        headers.forEach(headerText => {
            const th = document.createElement('th');
            th.textContent = headerText;

            if (headerText === 'Nombre') {
                th.id = 'header-nombre';
            } else if (headerText === 'Edad') {
                th.id = 'header-edad';
            }

            headerRow.appendChild(th);
        });
        thead.appendChild(headerRow);
        table.appendChild(thead);

        // Crear las filas de datos
        data.items.forEach(item => {
            const row = document.createElement('tr');

            const nameCell = document.createElement('td');
            nameCell.textContent = item.name;
            row.appendChild(nameCell);

            const ageCell = document.createElement('td');
            ageCell.textContent = item.age;
            row.appendChild(ageCell);
            ageCell.id = "fila-edad";

            const apellidoCell = document.createElement('td');
            apellidoCell.textContent = item.apellido;
            row.appendChild(apellidoCell);

            tbody.appendChild(row);
        });

        table.appendChild(tbody);
        container.appendChild(table);
    })
    .catch(error => console.error('Error:', error));
});