<?php
require_once "SuperGuerrer.php";
require_once "Digimon.php";

echo "<h3>SAIYAJIN:</h3>";

$goku= new Saiyajin(nivel:1000,nombre:"Goku");
echo $goku->Saludar()."<br>";
echo $goku->Nivel()."<br>";
echo "<br>";

$vegeta= new Saiyajin("Vegeta", 950);
echo $vegeta->Saludar()."<br>";
echo $vegeta->Nivel()."<br>";
echo "<br>";

$gohan= new SuperGuerrer(nivel:1800, nombre:"Gohan");
echo $gohan->Saludar()."<br>";
echo $gohan->Nivel()."<br>";
echo $gohan->Transformacion()."<br>";
echo "<br>";

$krilin= new SuperGuerrer(nivel:499, nombre:"Krilin");
echo $krilin->Saludar()."<br>";
echo $krilin->Nivel()."<br>";
echo $krilin->Transformacion()."<br><br>";

echo "<h3>DIGIMON:</h3>";

// Instanciar 3 Digimones
$agumon = new Digimon("Agumon", "vacuna", 70, 50);
$palmon = new Digimon("Palmon", "planta", 55, 45);
$gabumon = new Digimon("Gabumon", "animal", 65, 55);

// Resultados
echo $agumon->saludar() . "<br>";
echo $palmon->saludar() . "<br>";
echo $gabumon->saludar() . "<br>";

echo "<br>" . $agumon->combatir($gabumon) . "<br>";
echo $palmon->combatir($agumon) . "<br>";