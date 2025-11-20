<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Separar las palabras de una frase</title>
    </head>

    <body>
    <h2>Separar las palabras de una frase</h2>
    <form method="post">
        <label for="texto">Introduce una frase acabada en punto:</label>
        <input type="text" id="texto" name="texto" required><br><br>
        <input type="submit" value="Empezar" id="calcular" name="calcular"><br><br>
    </form>

    <?php
    if(isset($_POST['calcular'])) {
        if(empty($_POST['texto'])){
        echo "Introduce una frase";
    } else {
        $texto = $_POST['texto'];
        $palabras = [];
        $palabraActual = "";

        
        if(substr($texto, -1) !== '.') {
            echo "La frase debe terminar con un punto.";
        } else {
            $frase = substr($texto, 0, -1);

        for($i = 0; $i < strlen($texto); $i++) {
            if($texto[$i] != ' ' && $texto[$i] != '.') {
                $palabraActual .= $texto[$i];
            } else {
                    $palabras[] = $palabraActual;
                    $palabraActual = "";
            }
        }

        echo "<table border='1'>";
        foreach($palabras as $palabra) {
            echo "<tr>";
            for($i = 0; $i < strlen($palabra); $i++) {
                echo "<td>".$palabra[$i]."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        }
    }
}
    ?>
    </body>
</html>