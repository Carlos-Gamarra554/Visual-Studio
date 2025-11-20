<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular el día de la semana</title>
    </head>

    <body>
    <h2>¿Qué día de la semana será?</h2>
    <form method="post">
        <label for="numero">Introduce un número del 1 al 7:</label>
        <input type="number" id="numero" name="numero" required><br><br>
        <input type="submit" value="Calcular" id="calcular" name="calcular">
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        if(empty($_POST['numero'])){echo "Introduce un número";}
    else {
        $numero = $_POST['numero'];

        switch ($numero) {
            case 1:
                echo "<h3>El día es Lunes</h3>";
                break;
            case 2:
                echo "<h3>El día es Martes</h3>";
                break;
            case 3:
                echo "<h3>El día es Miércoles</h3>";
                break;
            case 4:
                echo "<h3>El día es Jueves</h3>";
                break;
            case 5:
                echo "<h3>El día es Viernes</h3>";
                break;
            case 6:
                echo "<h3>El día es Sábado</h3>";
                break;
            case 7:
                echo "<h3>El día es Domingo</h3>";
                break;
            default:
                echo "<h3>Introduce solo números entre 1 y 7</h3>";
        }
    }
}
    ?>
    </body>
</html>