<?php
require_once 'Videoclub.php';
require_once 'Pelicula.php';
require_once 'Cd.php';
require_once 'Juego.php';
require_once 'Cliente.php';

echo "<h1>Videoclub Carlos Gamarra</h1>";

$vc = new Videoclub("Blockbuster UML");

$peli1 = new Pelicula("El Padrino", "Inglés", 175, "Drama");
$peli2 = new Pelicula("Matrix", "Español", 136, "Ciencia Ficción");

$cd1 = new Cd("Thriller", 42.19, "Pop");

$juego1 = new Juego("God of War", "PS5", "Acción");

$cli1 = new Cliente("Lucía Pérez");
$cli2 = new Cliente("Marcos Ruiz");
$cli3 = new Cliente("Ana Gómez");

$vc->agregarProducto($peli1);
$vc->agregarProducto($peli2);
$vc->agregarProducto($cd1);
$vc->agregarProducto($juego1);

$vc->agregarCliente($cli1);
$vc->agregarCliente($cli2);
$vc->agregarCliente($cli3);

$vc->mostrarProductos();
$vc->mostrarClientes();

echo "<h3>Alquileres realizados</h3>";

$vc->alquilarProducto($cli1, $peli1);
$vc->alquilarProducto($cli1, $peli2);
$vc->alquilarProducto($cli2, $juego1);
$vc->alquilarProducto($cli3, $cd1);
echo "<hr>";

$cli1->listarAlquileres();
$cli2->listarAlquileres();
$cli3->listarAlquileres();
?>