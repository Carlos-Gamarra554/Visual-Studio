<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diccionario Bilingüe</title>
    </head>

    <body>
    <h2>Diccionario Bilingüe (Español-Inglés)</h2>
        <form method="post">
            <label for="palabra">Introduce una palabra en castellano:</label>
            <input type="text" id="palabra" name="palabra" required><br><br>
            <input type="submit" value="Traducir" id="traducir" name="traducir"><br><br>

            <?php
            if(isset($_POST['traducir'])) {
                if(empty($_POST['palabra'])){
                    echo "Introduce una palabra";
                } else {
                   $palabra = strtolower($_POST['palabra']);

                   $diccionario = [
                    "casa" => "house",
                    "perro" => "dog",
                    "coche" => "car",
                    "ventana" => "window",
                    "libro" => "book",
                    "mesa" => "table",
                    "silla" => "chair",
                    "comida" => "food",
                    "agua" => "water"
                   ];

                   if (array_key_exists($palabra, $diccionario)) {
                        echo "La traducción de <strong>$palabra</strong> es <strong>" . $diccionario[$palabra] . "</strong>.";
                    } else {
                        echo "La palabra <strong>$palabra</strong> no está en el diccionario.";
                    }
                }
            }
            ?>
        </form>
    </body>
</html>
