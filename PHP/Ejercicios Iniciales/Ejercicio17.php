<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de números capicúa</title>
    </head>

    <body>
    <h2>Calculadora de números capicúa</h2>
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

        function invertirNumero($num) {
            $reverso = 0;
            while ($num > 0) {
                $digito = $num % 10;
                $reverso = ($reverso * 10) + $digito;
                $num = (int)($num / 10);
            }
            return $reverso;
        }

        $numero = $_POST['numero'];
        $reverso = invertirNumero($numero);

        if ($numero == $reverso) {
            echo "El número $numero es capicúa.";
        } else {
            echo "El número $numero no es capicúa.";
        }
    }
}
    ?>
    </body>
</html>