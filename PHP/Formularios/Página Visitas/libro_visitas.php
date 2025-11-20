<?php
require_once 'biblioteca.php';

verificar_sesion();
mostrar_header('Comentarios de los Visitantes');

$visitas = obtener_visitas();

if (empty($visitas)) {
    echo "<p>Aún no hay comentarios. ¡Sé el primero!</p>";
} else {
    echo "<table>";
    echo "<tr><th>Fecha</th><th>Usuario</th><th>Comentario</th></tr>";
    foreach ($visitas as $visita) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars(date('Y-m-d', strtotime($visita['fecha']))) . "</td>";
        echo "<td>" . htmlspecialchars($visita['usuario']) . "</td>";
        echo "<td>" . htmlspecialchars($visita['comentario']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
<p><a href="nueva_visita.php">Añadir un nuevo comentario</a></p>

</body>
</html>