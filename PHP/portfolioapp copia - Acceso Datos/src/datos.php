<?php
//Leemos el contenido de los ficheros JSON
$json_usuarios = file_get_contents('mysql/usuarios.json');

//Decodificamos el JSON a arrays asociativos de PHP
$usuarios = json_decode($json_usuarios, true);

$miNombre = "Carlos Gamarra Tomás";