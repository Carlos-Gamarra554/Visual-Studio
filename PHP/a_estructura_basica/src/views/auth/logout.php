<?php
require_once "controllers/authController.php";
$controlador = new AuthController();
$controlador->doLogout();
?>