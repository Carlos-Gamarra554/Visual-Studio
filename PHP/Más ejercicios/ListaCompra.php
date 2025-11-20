<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de la compra</title>
    </head>

    <body>
    <h2>Lista de la compra</h2>
        <form method="post">
            <label for="articulo">Introduce los artículos que desee separados por espacios:</label>
            <input type="text" id="articulo" name="articulo" required><br><br>
            <input type="submit" value="Aceptar" id="aceptar" name="aceptar"><br><br>

            <?php
            if(isset($_POST['aceptar'])) {
                if(empty($_POST['articulo'])){
                    echo "Introduce algún producto";
                } else {
                    $productos = $_POST['articulo'];
                    $lista = explode(" ", $productos);

                    echo "<ul>-Lista de la compra:";
                    foreach($lista as $item) {
                        if(!empty($item) && $item != 'y') {
                        echo "<li>".$item."</li>";
                        }
                    }
                    echo "</ul>";
                }
            }
            ?>
        </form>
    </body>
</html>
