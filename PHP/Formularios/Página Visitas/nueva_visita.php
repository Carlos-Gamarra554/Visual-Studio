<?php
require_once 'biblioteca.php';

verificar_sesion();
mostrar_header('Añadir Nuevo Comentario');
?>

<form action="insertar_visita.php" method="post">
    <label for="comentario">Tu comentario:</label><br>
    <textarea id="comentario" name="comentario" rows="5" cols="50" required></textarea><br><br>
    <input type="submit" value="Guardar Comentario">
</form>

</body>
</html>