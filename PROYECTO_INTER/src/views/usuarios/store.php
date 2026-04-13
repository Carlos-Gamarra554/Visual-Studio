<?php
require_once "controllers/usersController.php";

// 1. Si no hay datos POST, redirigir al inicio
if (empty($_POST)) {
   header('Location: index.php?tabla=usuarios&accion=listar');
   exit();
}

$controlador = new UsersController();

// 2. Recogemos los datos del formulario
$arrayUser = [    
    "id"              => $_POST["id"] ?? null, 
    "nombre"          => $_POST["nombre"] ?? "",
    "email"           => $_POST["email"] ?? "",
    "password"        => $_POST["password"] ?? "",
    "rol"             => $_POST["rol"] ?? "usuario",
    "emailOriginal"   => $_POST["emailOriginal"] ?? ($_POST["email"] ?? ""),
    "idOriginal"      => $_POST["id"] ?? null
];

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "modificar" && !empty($arrayUser["id"])) {
    $controlador->editar($arrayUser["id"], $arrayUser);
} else {
    $controlador->crear($arrayUser);
}
?>