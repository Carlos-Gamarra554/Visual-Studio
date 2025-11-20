<?php
if (!isset ($_GET["correcto"],$_GET["name"],$_GET["edad"]) || $_GET["correcto"]!=true)  
    header("location:login.php?error_msg=No te pases de LISTO");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    BIENVENIDO <?= $_GET["name"]  ?> y TIENES <?= $_GET["edad"]  ?> AÑOS
</body>
</html>