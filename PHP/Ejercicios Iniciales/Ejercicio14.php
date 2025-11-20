<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobador de números primos</title>
    </head>

    <body>
    <h2>Comprobador de números primos</h2>
    <form method="post">
        <label for="numero">Introduce un número:</label>
        <input type="number" id="numero" name="numero" required><br><br>
        <input type="submit" value="Calcular" id="calcular" name="calcular"><br><br>
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        if(empty($_POST['numero'])){echo "Introduce un número";}
    else {
        $numero = $_POST['numero'];
        $esPrimo = true;

        if($numero <= 1) {
            $esPrimo = false;
        } else {
            for($i = 2; $i < $numero and $esPrimo = true; $i++) {
                if($numero % $i == 0) {
                    $esPrimo = false;
                } else {
                    $esPrimo = true;
                }
            }
        }
        if($esPrimo) {
            echo "El número $numero es primo.";
        } else {
            echo "El número $numero no es primo.";
        }
    }
}
    ?>
    </body>
</html>