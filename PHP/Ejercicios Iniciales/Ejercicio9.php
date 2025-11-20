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

        <label for="numero">Introduce otro número:</label>
        <input type="number" id="numero2" name="numero2" required><br><br>
        <input type="submit" value="Calcular" id="calcular" name="calcular">
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        if(empty($_POST['numero'])){echo "Introduce un número";}
    else {
        $numero = $_POST['numero'];
        $numero2 = $_POST['numero2'];
        if($numero > $numero2){
            if ($numero % $numero2 == 0) {
                echo "<h3>El número $numero es mayor y es divisible entre $numero2</h3>";
            } else {
                echo "<h3>El número $numero es mayor pero no es divisible entre $numero2</h3>";
            }
        }
        else if ($numero < $numero2){
            if ($numero2 % $numero == 0) {
                echo "<h3>El número $numero2 es mayor y es divisible entre $numero</h3>";
            } else {
                echo "<h3>El número $numero2 es mayor pero no es divisible entre $numero</h3>";
            }
        } else {
            echo "<h3>Ambos números son iguales y por tanto ambos son divisibles entre el otro</h3>";
        }
    }
}
    ?>
    </body>
</html>