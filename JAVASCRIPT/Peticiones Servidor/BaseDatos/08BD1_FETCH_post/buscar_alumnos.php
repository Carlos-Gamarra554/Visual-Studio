<?php
$servidor = "localhost";
$usuario  = "root";
$password = "";
$bd       = "ada";

$conexion = new mysqli($servidor, $usuario, $password, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");

// Ahora leemos desde POST
$puntuacion = isset($_POST['puntuacion']) ? (int) $_POST['puntuacion'] : 0;

$sql = "SELECT alumno, puntuacion FROM alumnos WHERE puntuacion > $puntuacion";
$resultado = $conexion->query($sql);

$alumnos = array();
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $alumnos[] = $fila;
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($alumnos);

$conexion->close();
