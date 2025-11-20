document.addEventListener("DOMContentLoaded", (event) => {

const formulario = document.getElementById("formulario");
const errores = document.getElementById("errores");
let mensajeError = "";

function comprobarNombre() {
    const nombre = document.getElementById("nombre");
    const apellidos = document.getElementById("apellidos");

    let esValido = true;
    const regex = /^[a-zA-Z\s]+$/;

    errores.innerHTML = "";
    nombre.classList.remove("error");
    apellidos.classList.remove("error");

    if (nombre.value.trim() === "") {
        mensajeError += "Introduzca su nombre, por favor.<br>";
        nombre.classList.add("error");
        nombre.focus();
        esValido = false;
    } else if (!regex.test(nombre.value.trim())) {
        mensajeError += "El nombre solo debe incluir letras y espacios.<br>";
        nombre.classList.add("error");
        nombre.focus();
        esValido = false;       
    }

    if (apellidos.value.trim() === "") {
        mensajeError += "Introduzca sus apellidos, por favor.<br>";
        apellidos.classList.add("error");
        apellidos.focus();
        esValido = false;
    } else if (!regex.test(apellidos.value.trim())) {
        mensajeError += "Los apellidos solo deben incluir letras y espacios.<br>";
        apellidos.classList.add("error");
        apellidos.focus();
        esValido = false;
    }

    errores.innerHTML = mensajeError;
    return esValido;
}

function comprobarEdad() {
    const edad = document.getElementById("edad");
    let esValido = true;

    errores.innerHTML = "";
    edad.classList.remove("error");

    if (edad.value.trim() === "") {
        mensajeError += "Introduzca su edad, por favor.<br>";
        edad.classList.add("error");
        edad.focus();
        esValido = false;
    } else if (isNaN(edad.value.trim()) || edad.value.trim() < 0 || edad.value.trim() > 105) {
        mensajeError += "Introduzca un número entre 0 y 105.<br>";
        edad.classList.add("error");
        edad.focus();
        esValido = false;
    }

    errores.innerHTML += mensajeError;
    return esValido;
}

function comprobarNIF() {
    const nif = document.getElementById("nif");
    let esValido = true;
    const regex = /^[0-9]{8}[a-zA-Z]$/;

    errores.innerHTML = "";
    nif.classList.remove("error");

    if (nif.value.trim() === "") {
        mensajeError += "Introduzca su nif, por favor.<br>";
        nif.classList.add("error");
        nif.focus();
        esValido = false;
    } else if (!regex.test(nif.value.trim())) {
        mensajeError += "El nif introducido no es válido.<br>";
        nif.classList.add("error");
        nif.focus();
        esValido = false;
    }

    errores.innerHTML += mensajeError;
    return esValido;
}

    formulario.addEventListener("submit", function(e) {
        if (!comprobarNombre() || !comprobarEdad() || !comprobarNIF()) {
            e.preventDefault();
            return false;
        }
    });
});