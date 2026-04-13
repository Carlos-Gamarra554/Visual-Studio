die("El index funciona");
<?php 
session_start();
ob_start(); 

require_once("router/router.php");

// 1. Decidimos la vista
$vista = router();
var_dump($vista);

// 2. DETECTAMOS SI ESTAMOS EN LOGIN O REGISTRO
// Si la tabla es 'auth' (login) o la acción es 'registro' (usuarios), activamos el modo pantalla completa
$tabla = $_REQUEST['tabla'] ?? 'inicio';
$accion = $_REQUEST['accion'] ?? 'listar';

$esPaginaLogin = ($tabla == 'auth' || $accion == 'crear');

// 3. Cargamos la cabecera (le pasamos la variable $esPaginaLogin implícitamente)
require_once("views/layout/header.php");

// 4. Cargamos la vista
if ($vista != null && file_exists($vista)) {
    require_once($vista);
} else {
    echo "<div style='padding:50px; text-align:center;'><h2>Error 404</h2><p>Archivo no encontrado.</p></div>";
}

// 5. Cargamos el footer
require_once("views/layout/footer.php");

ob_end_flush();
?>