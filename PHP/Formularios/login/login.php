<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $msg = "";
    if (isset($_GET["error_msg"])) {
        $msg = $_GET["error_msg"];
    }
    echo $msg;
    ?>

    <?= isset($_GET["error_msg"]) ? $_GET["error_msg"] : ""  ?>
   
    <?= ($_GET["error_msg"]) ??""  ?>

    <form action="comprobar.php" method="post">
        Usuario<input type="text" name="usuario" id="usuario" 
        value="<?= $_GET['usuario']??"" ?>"> <br>
        Contraseña<input type="password" name="contra" id="contra">
        <input type="submit" value="LOGIN">
    </form>
</body>

</html>




