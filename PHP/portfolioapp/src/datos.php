<?php
//Leemos el contenido de los ficheros JSON
$json_proyectos1 = file_get_contents('mysql/datos_proyectos1.json');
$json_proyectos2 = file_get_contents('mysql/datos_proyectos2.json');
$json_usuarios = file_get_contents('mysql/usuarios.json');

//Decodificamos el JSON a arrays asociativos de PHP
$proyectos_array1 = json_decode($json_proyectos1, true);
$proyectos_array2 = json_decode($json_proyectos2, true);
$usuarios = json_decode($json_usuarios, true);

//Unimos los dos arrays en uno solo
$proyectos = array_merge($proyectos_array1, $proyectos_array2);

$miNombre = "Carlos Gamarra Tomás";
?>