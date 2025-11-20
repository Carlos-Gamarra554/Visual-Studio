<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular el número mayor</title>
    </head>

    <body>
    <h2>¿Cuál es el número mayor?</h2>
    <form method="post">
        <label for="numero">Introduce un número:</label>
        <input type="number" id="numero" name="numero" required><br><br>

        <label for="numero2">Introduce un segundo número:</label>
        <input type="number" id="numero2" name="numero2" required><br><br>

        <label for="numero3">Introduce un último número:</label>
        <input type="number" id="numero3" name="numero3" required><br><br>
        <input type="submit" value="Calcular" id="calcular" name="calcular">
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        if(empty($_POST['numero'])){echo "Introduce un número";}
    else {
        $numero = $_POST['numero'];
        $numero2 = $_POST['numero2'];
        $numero3 = $_POST['numero3'];
        $respuesta = "";

        if($numero > $numero2 && $numero > $numero3){
            $respuesta = $numero." ";
            if ($numero2 > $numero3 || $numero2 == $numero3) {
                $respuesta .= $numero2." ".$numero3;
            } else {
                $respuesta .= $numero3." ".$numero2;
            }
        }
        else if ($numero2 > $numero && $numero2 > $numero3){
            $respuesta = $numero2." ";
            if ($numero > $numero3 || $numero == $numero3) {
                $respuesta .= $numero." ".$numero3;
            } else {
                $respuesta .= $numero3." ".$numero;
            }
        }
        else if ($numero3 > $numero && $numero3 > $numero2){
            $respuesta = $numero3." ";
            if ($numero > $numero2 || $numero == $numero2) {
                $respuesta .= $numero." ".$numero2;
            } else {
                $respuesta .= $numero2." ".$numero;
            }
        }
        else {
            echo "<h3>Todos los número son iguales y no se pueden ordenar</h3>";
        }
        echo "<h3>El orden de mayor a menor es: ".$respuesta."</h3>";
    }
}
    ?>
    </body>
</html>