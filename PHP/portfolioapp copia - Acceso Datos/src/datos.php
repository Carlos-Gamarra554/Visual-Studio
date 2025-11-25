<?php
//Leemos el contenido de los ficheros JSON
$json_proyectos = file_get_contents('mysql/datos_proyectos.json');
$json_usuarios = file_get_contents('mysql/usuarios.json');

//Decodificamos el JSON a arrays asociativos de PHP
$proyectos_array = json_decode($json_proyectos, true);
$usuarios = json_decode($json_usuarios, true);

//Unimos los dos arrays en uno solo
$proyectos = $proyectos_array;

$miNombre = "Carlos Gamarra Tomás";