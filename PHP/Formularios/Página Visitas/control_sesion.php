<?php
session_start();
if (!isset ($_SESSION["user"],$_SESSION["datos"])) {
    $_SESSION=[];
    session_destroy();
    header("location:login.php?error_msg=No te pases de LISTO");
    exit ();
} 

?>