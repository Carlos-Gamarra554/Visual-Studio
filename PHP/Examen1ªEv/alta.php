<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Nuevo Usuario</title>
    </head>
<body>
    <h1>Crear Nueva Cuenta</h1>

    <?php
    // Mostrar mensajes de error
    if (isset($_GET['error'])) {
        $error = ($_GET['error']);
        echo "<p>Error: $error</p>";
    }
    ?>

    <form action="comprobarAlta.php" method="POST">
        <div>
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>
            <br><br>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br><br>
        </div>
        <div>
            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br><br>
        </div>
        <div>
            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required>
            <br><br>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <br><br>
        </div>
        <div>
            <label for="password_confirm">Confirmar Contraseña:</label>
            <input type="password" id="password_confirm" name="password_confirm" required>
            <br><br>
        </div>
        <button type="submit">Registrarse</button>
    </form>
    <br>
    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
</body>
</html>