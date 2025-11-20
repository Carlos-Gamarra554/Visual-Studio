<?php
require_once "control_sesion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= "BIENVENIDO {$_SESSION["datos"]["name"]}   y TIENES {$_SESSION["datos"]["name"]}  AÑOS";
    ?>
    <a href="segunda.php">SEGUNDA PAGINA</a>
</body>
</html>