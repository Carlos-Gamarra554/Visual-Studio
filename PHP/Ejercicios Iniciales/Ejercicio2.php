<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuadrado de un número</title>
    </head>

    <body>
    <h2>Cuadrado de un número usando PHP</h2>
    <form method="post">
        <label for="numero">Introduce el radio de una circunferencia:</label>
        <input type="number" id="numero" name="numero" required><br><br>
        <input type="submit" value="Calcular" id="calcular" name="calcular">
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        if(empty($_POST['numero'])){echo "Introduce un número";}
    else {
        $numero = $_POST['numero'];
        $doble = $numero * 2;
        $area = pi() * ($numero * $numero);
        echo "<h3>La longitud de la circunferencia es de $doble cm y su área de $area m2</h3>";
        }
    }
    ?>
    </body>
</html>