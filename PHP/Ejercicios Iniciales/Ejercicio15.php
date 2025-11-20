<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de divisores</title>
    </head>

    <body>
    <h2>Calculadora de divisores</h2>
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
        $resultado = "Los divisores del número $numero son: 1, ";

        for($i = 2; $i < $numero; $i++) {
            if($numero % $i == 0) {
                $resultado .= "$i, ";
            }
        }
        echo $resultado."$numero.";
    }
}
    ?>
    </body>
</html>