<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir un triángulo</title>
    </head>

    <body>
    <h2>Imprimir un triángulo</h2>
    <form method="post">
        <label for="numero">Introduce un número:</label>
        <input type="number" id="numero" name="numero" required><br><br>
        <input type="submit" value="Empezar" id="calcular" name="calcular"><br><br>
    </form>

    <?php
    if(isset($_POST['calcular'])) {
    if(empty($_POST['numero'])){
        echo "Introduce un número";
    } else {
        $numero = $_POST['numero'];

        for ($i = 1; $i <= $numero; $i++) {
            $cadena = "";

            for ($s = 1; $s <= $numero - $i; $s++) {
                $cadena .= " ";
            }

            for ($j = 1; $j <= $i; $j++) {
                $cadena .= $j;
            }

            for ($j = $i-1; $j >= 1; $j--) {
                $cadena .= $j;
            }

            echo $cadena."<br>";
        }
    }
}
    ?>
    </body>
</html>