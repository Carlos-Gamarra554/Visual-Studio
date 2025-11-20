<?php
// Aquí comprobamos que el usuario de la sesión existe y por tanto pueda acceder al sitio
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=requerido");
    exit;
}
?>