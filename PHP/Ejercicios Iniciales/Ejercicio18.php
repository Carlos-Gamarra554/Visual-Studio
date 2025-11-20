<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobador de textos palíndromos</title>
    </head>

    <body>
    <h2>Comprobador de textos palíndromos</h2>
    <form method="post">
        <label for="texto">Introduce un texto:</label>
        <input type="text" id="texto" name="texto" required><br><br>
        <input type="submit" value="Comprobar" id="calcular" name="calcular"><br><br>
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        if(empty($_POST['texto'])){echo "Introduce un texto";}
    else {
        $texto = $_POST['texto'];
        $textoMinuscula = strtolower($_POST['texto']);

        function invertirTexto($texto) {
            $reverso = "";
            for ($i = strlen($texto) - 1; $i >= 0; $i--) {
                $reverso .= $texto[$i];
            }
            return $reverso;
        }

        $reverso = invertirTexto($textoMinuscula);

        if ($textoMinuscula === $reverso) {
            echo "El texto '$texto' es palíndromo.";
        } else {
            echo "El texto '$texto' no es palíndromo.";
        }
    }
}
    ?>
    </body>
</html>