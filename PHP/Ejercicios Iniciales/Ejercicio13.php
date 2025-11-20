<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darle la vuelta a un texto</title>
    </head>

    <body>
    <h2>Imprimir la frase al revés</h2>
    <form method="post">
        <label for="texto">Introduce una frase:</label>
        <input type="text" id="texto" name="texto" required><br><br>
        <input type="submit" value="Empezar" id="calcular" name="calcular">
    </form>

    <?php
    if(isset($_POST['calcular']))
    {
        if(empty($_POST['texto'])){echo "Introduce un texto";}
    else {
        $texto = $_POST['texto'];
        for ($i = strlen($texto); $i > 0; $i--) {
            echo $texto[$i - 1];
        }
    }
}
    ?>
    </body>
</html>