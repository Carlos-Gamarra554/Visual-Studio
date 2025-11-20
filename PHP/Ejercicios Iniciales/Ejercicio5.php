<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distancia entre dos puntos</title>
    </head>

    <body>
    <h2>Calcular distancia entre dos puntos</h2>
    <form method="post">
        <label for="x1">Coordenada x1:</label>
        <input type="number" id="x1" name="x1" required><br><br>

        <label for="y1">Coordenada y1:</label>
        <input type="number" id="y1" name="y1" required><br><br>

        <label for="x2">Coordenada x2:</label>
        <input type="number" id="x2" name="x2" required><br><br>

        <label for="y2">Coordenada y2:</label>
        <input type="number" id="y2" name="y2" required><br><br>

        <input type="submit" value="Calcular" id="calcular" name="calcular">
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        $x1 = $_POST['x1'];
        $y1 = $_POST['y1'];
        $x2 = $_POST['x2'];
        $y2 = $_POST['y2'];

        $distancia = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));

        echo "<h3>La distancia entre los puntos ($x1, $y1) y ($x2, $y2) es de: $distancia m</h3>";
    }
    ?>
    </body>
</html>