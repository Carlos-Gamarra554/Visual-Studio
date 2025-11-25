<?php
//Actividad 1. f) Cuando se pulsa en log out se borra la cookie y se redirige a index.php
//Como consecuencia, se cambia el log out por el log in y se oculta administración
if (isset($_COOKIE['user_email'])) {
    setcookie("user_email", "", time() - 3600, "/");
}

header("Location: index.php?logout=true");
exit();
?>