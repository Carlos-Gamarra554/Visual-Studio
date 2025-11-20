<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Separar las frases de un texto</title>
    </head>

    <body>
    <h2>Separar las frases de un texto</h2>
    <form method="post">
        <label for="texto">Introduce un texto:</label>
        <input type="text" id="texto" name="texto" required><br><br>
        <input type="submit" value="Empezar" id="calcular" name="calcular"><br><br>
    </form>

    <?php
    if(isset($_POST['calcular'])) {
    if(empty($_POST['texto'])){
        echo "Introduce un número";
    } else {
        $texto = $_POST['texto'];
        $frases = [];
        $fraseActual = "";

        for($i = 0; $i < strlen($texto); $i++) {
            $fraseActual .= $texto[$i];

            if($texto[$i] == '.') {
                $frases[] = $fraseActual;
                $fraseActual = "";
            }
        }

        //Agregar la última frase si no termina en punto
        if(!empty($fraseActual)) {
            $frases[] = $fraseActual;
        }

        //Imprimir las frases en líneas separadas
        for ($i = 0; $i < count($frases); $i++) {
            echo "<p>".$frases[$i]."</p>";
        }
    }
}
    ?>
    </body>
</html>