document.addEventListener('DOMContentLoaded', function() {
    const loginSection = document.getElementById('loginSection');
    const fechaSection = document.getElementById('fechaSection');
    const recursosSection = document.getElementById('recursosSection');

    const loginInput = document.getElementById('idUsuario');
    const loginMessage = document.getElementById('loginMessage');
    
    const diaInput = document.getElementById('dia');
    const mesInput = document.getElementById('mes');
    const anioInput = document.getElementById('ano');
    
    const recursosSelect = document.getElementById('recursosSelect');
    const reservaMessage = document.getElementById('reservaMessage');

    const botonVerificar = document.getElementById('verificarBtn');
    const botonEnviarFecha = document.getElementById('enviarFechaBtn');
    const botonReservar = document.getElementById('reservarBtn');

    let fechaMilisegundos = null;
    let usuarioLogueado = null;

    botonVerificar.addEventListener('click', function() {
        const idUsuario = parseInt(loginInput.value);

        if (isNaN(idUsuario)) {
            loginMessage.textContent = "Introduce un ID válido";
            return;
        }

        fetch('server.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                action: 'verificarUsuario', 
                idUsuario: idUsuario
            }) 
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                loginMessage.textContent = "";
                loginSection.style.display = 'none';
                fechaSection.style.display = 'block';
                
                usuarioLogueado = idUsuario;
            } else {
                loginMessage.textContent = "Usuario no válido.";
            }
        })
        .catch(error => {
            console.error(error);
            loginMessage.textContent = "Error al verificar el usuario.";
        });
    });

    botonEnviarFecha.addEventListener('click', function() {
        const dia = parseInt(diaInput.value);
        const mes = parseInt(mesInput.value);
        const anio = parseInt(anioInput.value);

        if (!dia || !mes || !anio) {
            alert("Fecha inválida");
            return;
        }

        const fechaObj = new Date(anio, mes - 1, dia);
        fechaMilisegundos = fechaObj.getTime();

        fetch('server.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'obtenerRecursos', fecha: fechaMilisegundos })
        })
        .then(response => response.json())
        .then(data => {
            recursosSelect.innerHTML = "";
            
            if (data.recursos && data.recursos.length > 0) {
                data.recursos.forEach(recurso => {
                    const opcion = document.createElement('option');
                    opcion.value = recurso.idRecurso;
                    opcion.textContent = recurso.nombre;
                    recursosSelect.appendChild(opcion);
                });
                
                fechaSection.style.display = 'none';
                recursosSection.style.display = 'block';
            } else {
                alert("No hay recursos disponibles para esa fecha.");
            }
        })
        .catch(console.error);
    });

    botonReservar.addEventListener('click', function() {
        const idRecurso = parseInt(recursosSelect.value);

        fetch('server.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                action: 'guardarReserva',
                idUsuario: usuarioLogueado,
                idRecurso: idRecurso,
                fecha: fechaMilisegundos
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                reservaMessage.textContent = data.message;
                botonReservar.disabled = true;
            } else {
                reservaMessage.textContent = data.message
            }
        })
        .catch(error => {
            console.error(error);
            reservaMessage.textContent = "Error de conexión al reservar.";
        });
    });
});