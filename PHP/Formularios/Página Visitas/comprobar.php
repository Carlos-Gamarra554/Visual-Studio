<?php
session_start();

$usuarios_permitidos = [
    'admin' => 'admin123',
    'juan' => 'clave_juan',
    'ana' => 'ana_secreta'
];

$usuario = $_POST['usuario'] ?? '';
$contra = $_POST['contra'] ?? '';

// Comprobar si el usuario existe y la contraseña es correcta
if (isset($usuarios_permitidos[$usuario]) && $usuarios_permitidos[$usuario] === $contra) {
    // Login correcto: guardar usuario en la sesión
    $_SESSION['usuario'] = $usuario;
    header('Location: inicio.php');
} else {
    // Login incorrecto: redirigir con un mensaje de error
    header('Location: login.php?error=1');
}

exit();
?>