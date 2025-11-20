<?php
session_start();

define('FICHERO_VISITAS', 'visitas.txt');

function verificar_sesion() {
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php?error=2');
        exit();
    }
}

function obtener_visitas() {
    $visitas = [];
    if (file_exists(FICHERO_VISITAS)) {
        $lineas = file(FICHERO_VISITAS, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lineas as $linea) {
            list($fecha, $usuario, $comentario) = explode('|:|', $linea);
            $visitas[] = ['fecha' => $fecha, 'usuario' => $usuario, 'comentario' => $comentario];
        }
    }
    return array_reverse($visitas);
}

function anadir_visita($usuario, $comentario) {
    $fecha = date('Y-m-d');
    
    $linea = "{$fecha}|:|{$usuario}|:|{$comentario}" . PHP_EOL;
    
    file_put_contents(FICHERO_VISITAS, $linea, FILE_APPEND);
}

function mostrar_header($titulo) {
    $nombre_usuario = htmlspecialchars($_SESSION['usuario'] ?? '');
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Libro de Visitas</title>
    </head>
    <body>
        <nav>
            <a href="inicio.php">Inicio</a>
            <a href="libro_visitas.php">Ver Visitas</a>
            <a href="nueva_visita.php">Añadir Visita</a><br><br>
            <div class="user-info">
                <span>Hola, <strong>{$nombre_usuario}</strong></span>
                <a href="logout.php">Cerrar Sesión</a>
            </div>
        </nav>
        <h1>{$titulo}</h1>
    HTML;
}

?>