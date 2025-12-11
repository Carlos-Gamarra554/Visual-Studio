<?php
header("Content-Type: application/json");

// Leer archivo JSON
$datos = file_get_contents("personas.json");

// Enviar los datos al cliente
echo $datos;