<?php
require_once "Equipo.php";

$goku= new Saiyajin(nivel:1000,nombre:"Goku");
$vegeta= new Saiyajin("Vegeta", 950);
$gohan= new SuperGuerrer(nivel:1800, nombre:"Gohan");

$equipo= new Equipo($goku, $vegeta, $gohan);

echo "/*******Equipo Original*****/<br>";
$equipo->ImprimirEquipo();

$trunks= new Saiyajin ("Trunks", 2000);
$equipo->setSaiyajin1($trunks);
echo "/*******NUEVO EQUIPO*****/<br>";
$equipo->ImprimirEquipo();