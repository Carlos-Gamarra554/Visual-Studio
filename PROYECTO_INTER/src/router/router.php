<?php
function router (){
    $url = $_SERVER["REQUEST_URI"];

    // Rutas base
    if (substr ($url,-1)=="/") return "views/inicio.php";
    if (!strpos ($url,"index.php")) return "views/404.php";
    if (!isset ($_REQUEST["tabla"])) return "views/inicio.php";

    $tablas=[
        "usuarios"=> [
            "crear"=>"create.php",
            "guardar"=>"store.php",
            "ver"=> "show.php",
            "listar"=>"list.php",
            "buscar"=>"search.php",
            "borrar"=>"delete.php",
            "editar"=>"edit.php"
        ],
        "auth" => [
            "login" => "auth/login.php",
            "validar" => "auth/validate.php",
            "logout" => "auth/logout.php"
        ]
    ];

    $tabla = $_REQUEST["tabla"];
    if (!isset($tablas[$tabla])) return "views/404.php"; 

    // Acción por defecto
    if (!isset ($_REQUEST["accion"])) {
        if ($tabla == 'auth') return "views/auth/login.php";
        return "views/{$tabla}/list.php";
    }

    $accion = $_REQUEST["accion"];
    if (!isset($tablas[$tabla][$accion])) return "views/404.php"; 
   
    if ($tabla == 'auth') {
        return "views/{$tablas[$tabla][$accion]}";
    }
    
    return "views/{$tabla}/{$tablas[$tabla][$accion]}";
}
?>