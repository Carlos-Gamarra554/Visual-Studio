<?php
require_once 'biblioteca.php';

verificar_sesion();

if (isset($_POST['comentario']) && !empty(trim($_POST['comentario']))) {
    $usuario = $_SESSION['usuario'];
    $comentario = $_POST['comentario'];
    
    anadir_visita($usuario, $comentario);
}

header('Location: libro_visitas.php');
exit();
?>