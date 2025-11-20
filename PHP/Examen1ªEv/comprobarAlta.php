<?php
require "usuarios.php";

//Recoger los datos del formulario
$username = $_POST['username'];
$email = $_POST['email'];
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

// Comprobar que no haya campos vacíos
if (empty($username) || empty($email) || empty($nombre) || empty($edad) || empty($password)) {
    header("Location: alta.php?error=Todos los campos son obligatorios");
    exit;
}

// Comprobar que las contraseñas sean iguales
if ($password !== $password_confirm) {
    header("Location: alta.php?error=Las contraseñas no coinciden");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: alta.php?error=Email no válido");
    exit;
}

// Comprobar si el usuario o email ya existen
foreach ($usuarios as $user) {
    if ($user['username'] === $username) {
        header("Location: alta.php?error=El nombre de usuario ya existe");
        exit;
    }
    if ($user['email'] === $email) {
        header("Location: alta.php?error=El email ya está registrado");
        exit;
    }
}

// Creación del nuevo usuario si no hay errores
$nuevo_usuario = [
    'username' => $username,
    'email' => $email,
    'nombre' => $nombre,
    'edad' => (int)$edad,
    'clave' => $password
];

// Añadir el nuevo usuario al array
$usuarios[] = $nuevo_usuario;

// Redirigir al login con mensaje de éxito
header("Location: login.php?status=registrado");
exit;
?>