<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distancia entre dos puntos en el espacio</title>
</head>
<body>
    <h2>Calcular distancia entre dos puntos en el espacio (3D)</h2>
    <form method="post">
        <label for="x1">x1:</label>
        <input type="number" step="any" id="x1" name="x1" required><br><br>

        <label for="y1">y1:</label>
        <input type="number" step="any" id="y1" name="y1" required><br><br>

        <label for="z1">z1:</label>
        <input type="number" step="any" id="z1" name="z1" required><br><br>

        <label for="x2">x2:</label>
        <input type="number" step="any" id="x2" name="x2" required><br><br>

        <label for="y2">y2:</label>
        <input type="number" step="any" id="y2" name="y2" required><br><br>

        <label for="z2">z2:</label>
        <input type="number" step="any" id="z2" name="z2" required><br><br>

        <input type="submit" value="Calcular distancia" name="calcular">
    </form>

    <?php
    if (isset($_POST['calcular'])) {
        $x1 = $_POST['x1'];
        $y1 = $_POST['y1'];
        $z1 = $_POST['z1'];
        $x2 = $_POST['x2'];
        $y2 = $_POST['y2'];
        $z2 = $_POST['z2'];

        // Fórmula de distancia en 3D
        $distancia = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2) + pow($z2 - $z1, 2));

        echo "<h3>La distancia entre los puntos ($x1, $y1, $z1) y ($x2, $y2, $z2) es: $distancia</h3>";
    }
    ?>
</body>
</html>