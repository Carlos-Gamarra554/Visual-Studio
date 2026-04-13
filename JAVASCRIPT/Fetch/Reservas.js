document.addEventListener('DOMContentLoaded', function() {
    const loginSection = document.getElementById('loginSection');
    const fechaSection = document.getElementById('fechaSection');
    const recursosSection = document.getElementById('recursosSection');

    const idUsuarioInput = document.getElementById('idUsuario');
    const verificarBtn = document.getElementById('verificarBtn');
    const loginMessage = document.getElementById('loginMessage');

    const diaInput = document.getElementById('dia');
    const mesInput = document.getElementById('mes');
    const anoInput = document.getElementById('ano');
    const enviarFechaBtn = document.getElementById('enviarFechaBtn');

    const recursosSelect = document.getElementById('recursosSelect');
    const reservarBtn = document.getElementById('reservarBtn');
    const reservaMessage = document.getElementById('reservaMessage');

    let idUsuarioGlobal = null;
    let fechaSeleccionadaMs = null;

    verificarBtn.addEventListener('click', function() {
        const id = parseInt(idUsuarioInput.value)

        if (isNaN(id)) {
            loginMessage.textContent = "Por favor, introduce un ID válido.";
            return;
        }

        fetch('server.php', {
            method: 'POST',
            body: JSON.stringify({ action: 'verificarUsuario', idUsuario: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                idUsuarioGlobal = id;
                loginSection.style.display = 'none';
                fechaSection.style.display = 'block';
                loginMessage.textContent = "";
            } else {
                loginMessage.textContent = "idUsuario no existe.";
            }
        })
        .catch(error => console.error('Error:', error));
    });

    enviarFechaBtn.addEventListener('click', function() {
        const dia = parseInt(diaInput.value);
        const mes = parseInt(mesInput.value) - 1;
        const ano = parseInt(anoInput.value);

        if (isNaN(dia) || isNaN(mes) || isNaN(ano)) {
            alert("Introduce una fecha válida.");
            return;
        }

        const fechaObj = new Date(ano, mes, dia);
        
        if (isNaN(fechaObj.getTime())) {
            alert("La fecha proporcionada no es válida.");
            return;
        }

        fechaSeleccionadaMs = fechaObj.getTime();

        fetch('server.php', {
            method: 'POST',
            body: JSON.stringify({ action: 'obtenerRecursos', fecha: fechaSeleccionadaMs })
        })
        .then(response => response.json())
        .then(data => {
            recursosSelect.innerHTML = "";

            if (data.recursos && data.recursos.length > 0) {
                data.recursos.forEach(recurso => {
                    const option = document.createElement('option');
                    option.value = recurso.idRecurso;
                    option.textContent = recurso.nombre;
                    recursosSelect.appendChild(option);
                });

                fechaSection.style.display = 'none';
                recursosSection.style.display = 'block';
            } else {
                alert("No hay recursos disponibles para esa fecha.");
            }
        })
        .catch(error => console.error('Error:', error));
    });

    reservarBtn.addEventListener('click', function() {
        const idRecurso = parseInt(recursosSelect.value);

        fetch('server.php', {
            method: 'POST',
            body: JSON.stringify({
                action: 'guardarReserva',
                idUsuario: idUsuarioGlobal,
                idRecurso: idRecurso,
                fecha: fechaSeleccionadaMs
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                reservaMessage.textContent = data.message;
                reservaMessage.style.color = "green";
            } else {
                reservaMessage.textContent = data.message;
                reservaMessage.style.color = "red";
            }
        })
        .catch(error => console.error('Error:', error));
    });
});