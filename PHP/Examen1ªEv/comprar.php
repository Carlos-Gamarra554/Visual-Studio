<?php
require 'autenticacion.php';
$artista = htmlspecialchars($_POST['artista']);
$precio_unidad = $_POST['precio'];
$cantidad = $_POST['cantidad'];

if ($cantidad <= 0) {
    header("Location: index.php");
    exit;
}

$precio = $cantidad * $precio_unidad;

if ($cantidad >= 6) {
    $precio = $precio * 0.9;
} elseif ($cantidad >= 4) {
    $precio = $precio * 0.95;
}

if (!isset($_SESSION['compras'])) {
    $_SESSION['compras'] = [];
}

$nueva_compra = [
    'artista' => $artista,
    'cantidad' => $cantidad,
    'subtotal' => $precio
];

$_SESSION['compras'][] = $nueva_compra;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra Confirmada</title>
    </head>
<body>
    <nav>
        <a href="index.php">Ver Entradas</a> | 
        <a href="perfil.php">Ver mi Perfil</a> | 
        <a href="logout.php">Cerrar Sesión</a>
    </nav>

    <h1>¡Gracias por tu compra!</h1>
    <p>Has adquirido <?php echo $cantidad; ?> entrada(s) para:
        <?php echo $artista; ?> por <?php echo $precio; ?>€</p>
    <a href="index.php">Volver a las entradas</a>
</body>
</html>