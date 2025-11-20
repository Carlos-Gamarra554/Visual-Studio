<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: inicio.php');
    exit();
}

$error_msg = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] == '1') {
        $error_msg = "Usuario o contraseña incorrectos.";
    } elseif ($_GET['error'] == '2') {
        $error_msg = "Debes iniciar sesión para acceder.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form action="comprobar.php" method="post">
        Usuario: <input type="text" name="usuario" required><br><br>
        Contraseña: <input type="password" name="contra" required><br><br>
        <input type="submit" value="Entrar">
    </form>
    <?php if ($error_msg): ?>
        <p><?= $error_msg ?></p>
    <?php endif; ?>
</body>
</html>