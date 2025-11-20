<?php
session_start();
require 'usuarios.php';

// Recoger datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Verificar el usuario
$usuario_valido = false;
foreach ($usuarios as $user) {
    if ($user['username'] === $username) {
        if ($user['clave'] === $password) {
            $usuario_valido = true;
            
            // Guardar los datos del usuario en la sesión
            $_SESSION['username'] = $user['username'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['edad'] = $user['edad'];
            
            header("Location: index.php");
            exit;
        }
    }
}

if (!$usuario_valido) {
    header("Location: login.php?error=incorrecto");
    exit;
}
?>