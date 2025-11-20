<?php
require 'autenticacion.php';

// Cargar las entradas desde el archivo entradas.php
require 'entradas.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entradas Disponibles</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h1>
        <nav>
            <a href="perfil.php">Ver mi Perfil</a> | 
            <a href="logout.php">Cerrar Sesión</a>
        </nav>

    <h2>Entradas Disponibles</h2>
        <?php foreach ($entradas as $entrada): ?>
                <h3><?php echo htmlspecialchars($entrada['artista']); ?></h3>
                <p><b>Precio: <?php echo htmlspecialchars($entrada['precio']); ?>€</b></p>
                
                <form action="comprar.php" method="POST">
                    <input type="hidden" name="artista" value="<?php echo $entrada['artista']; ?>">
                    <input type="hidden" name="precio" value="<?php echo htmlspecialchars($entrada['precio']); ?>">
                    
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" value="1" min="1" required>
                    <button type="submit">Comprar Esta Entrada</button>
                    <br><br>
                </form>
    <?php endforeach; ?>
</body>
</html>