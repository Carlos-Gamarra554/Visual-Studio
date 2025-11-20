<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobador de números pares o impares</title>
    </head>

    <body>
    <h2>Comprobar si es par o impar</h2>
    <form method="post">
        <label for="numero">Introduce un número:</label>
        <input type="number" id="numero" name="numero" required><br><br>
        <input type="submit" value="Calcular" id="calcular" name="calcular">
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        if(empty($_POST['numero'])){echo "Introduce un número";}
    else {
        $numero = $_POST['numero'];
        if($numero %2 != 0){
            echo "<h3>El número $numero es impar</h3>";
        }
        else{
            echo "<h3>El número $numero es par</h3>";
        }
        }
    }
    ?>
    </body>
</html>