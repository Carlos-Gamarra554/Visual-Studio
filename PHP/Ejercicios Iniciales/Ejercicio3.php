<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuadrado de un número</title>
    </head>

    <body>
    <h2>Convertir kilómetros en millas</h2>
    <form method="post">
        <label for="numero">Introduce una cantidad de km:</label>
        <input type="number" id="numero" name="numero" required><br><br>
        <input type="submit" value="Calcular" id="calcular" name="calcular">
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        if(empty($_POST['numero'])){echo "Introduce un número";}
    else {
        $numero = $_POST['numero'];
        $millas = $numero * 0.621371;
        echo "<h3>$numero kms son $millas millas terrestres</h3>";
        }
    }
    ?>
    </body>
</html>