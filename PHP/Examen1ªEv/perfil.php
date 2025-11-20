<?php
require 'autenticacion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    </head>
<body>
    <h1>Mi Perfil</h1>
    <nav>
        <a href="index.php">Ver Entradas</a> | 
        <a href="perfil.php"><b>Ver mi Perfil</b></a> | 
        <a href="logout.php">Cerrar Sesión</a>
    </nav>

    <h2>Información de tu cuenta</h2>
    <ul>
        <li><b>Usuario:</b> <?php echo htmlspecialchars($_SESSION['username']); ?></li>
        <li><b>Nombre:</b> <?php echo htmlspecialchars($_SESSION['nombre']); ?></li>
        <li><b>Email:</b> <?php echo htmlspecialchars($_SESSION['email']); ?></li>
        <li><b>Edad:</b> <?php echo htmlspecialchars($_SESSION['edad']); ?></li>
    </ul>
    
    <h2>Mis Compras</h2>
    <?php
    if (isset($_SESSION['compras']) && !empty($_SESSION['compras'])):
        foreach ($_SESSION['compras'] as $compra):
            echo "<p>";
            echo "<b>Entrada para:</b>" . htmlspecialchars($compra['artista']) . "<br><br>";
            echo "<b>-Cantidad:</b>" . $compra['cantidad'] . "<br>";
            echo "<b>-Precio Total</b>:" . $compra['subtotal'] . "€<hr>";
            echo "</p>";
        endforeach;
    else:
        echo "<p>No has comprado nada de momento.</p>";
    endif;
?>
</body>
</html>