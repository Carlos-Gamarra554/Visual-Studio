<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir del uno hasta un cierto número</title>
    </head>

    <body>
    <h2>Imprimir todos los números anteriores</h2>
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
        echo "<h3>Los números anteriores a $numero son:</h3>";
        for($i = 1; $i <= $numero; $i++){
            echo %i." ";
        }
    }
}
    ?>
    </body>
</html>