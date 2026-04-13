<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Si la variable no está definida, asumimos que es false
if (!isset($esPaginaLogin)) { $esPaginaLogin = false; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoteles Lunazul</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400..700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
</head>

<body class="<?= $esPaginaLogin ? 'body-login' : '' ?>">

    <?php if (!$esPaginaLogin): ?>
    
        <header class="main-header">
            <a href="index.php" class="contenedor-logo">
                <img src="/assets/img/logo.png" class="logo" alt="Logo Lunazul">
                <span class="texto-logo">LUNAZUL</span>
            </a>

            <nav class="main-nav">
                <ul class="lista-nav">
                    <li><a href="index.php" class="nav-link">Inicio</a></li>
                    <li><a href="index.php?accion=contacto" class="nav-link">Contacto</a></li>
                    <li><a href="index.php?accion=habitaciones" class="nav-link">Habitaciones</a></li>
                </ul>

                <?php if(isset($_SESSION['usuario_id'])): ?>
                    <a href="index.php?tabla=auth&accion=logout" class="btn btn-primary">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="index.php?tabla=auth&accion=login" class="btn btn-primary">Iniciar Sesión</a>
                <?php endif; ?>
            </nav>
        </header>

    <?php endif; ?>