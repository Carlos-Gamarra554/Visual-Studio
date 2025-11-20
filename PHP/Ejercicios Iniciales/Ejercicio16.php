<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mínimo común Múltiplo y Máximo común Divisor</title>
    </head>

    <body>
    <h2>Calculadora de M.C.M y M.C.D</h2>
    <form method="post">
        <label for="numero">Introduce un número:</label>
        <input type="number" id="numero" name="numero" required><br><br>

        <label for="numero2">Introduce otro número:</label>
        <input type="number" id="numero2" name="numero2" required><br><br>
        <input type="submit" value="Calcular" id="calcular" name="calcular"><br><br>
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        if(empty($_POST['numero'])){echo "Introduce un número";}
    else {
        function mcd($num, $num2) {
            $numMayor = max($num, $num2);
            $numMenor = min($num, $num2);

            while ($numMenor != 0) {
                $temp = $numMenor;
                $numMenor = $numMayor % $numMenor;
                $numMayor = $temp;
            }
            return $numMayor;
        }

        function mcm($num, $num2) {
            if ($num == 0 || $num2 == 0) return 0;
            return abs($num * $num2) / mcd($num, $num2);
        }

        $numero = $_POST['numero'];
        $numero2 = $_POST['numero2'];

        $resultadoMCD = mcd($numero, $numero2);
        $resultadoMCM = mcm($numero, $numero2);

        echo "El MCD de $numero y $numero2 es: $resultadoMCD<br>";
        echo "El MCM de $numero y $numero2 es: $resultadoMCM<br>";
    }
}
    ?>
    </body>
</html>