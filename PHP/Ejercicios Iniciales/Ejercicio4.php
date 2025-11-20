<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertir euros a dólares EE.UU.</title>
    </head>

    <body>
    <h2>Convertir euros a dólares EE.UU.</h2>
    <form method="post">
        <label for="numero">Introduce una cantidad de euros:</label>
        <input type="number" id="numero" name="numero" required><br><br>
        <input type="submit" value="Calcular" id="calcular" name="calcular">
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        if(empty($_POST['numero'])){echo "Introduce un número";}
    else {
        $numero = $_POST['numero'];
        $dollars = $numero * 1.18;
        echo "<h3>$numero euros son $dollars dólares estadounidenses</h3>";
        }
    }
    ?>
    </body>
</html>