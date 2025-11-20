<?php
include "Libros.php";
include "Funciones.php";

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Resultado de Biblioteca</title>
</head>
<body>";

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    switch ($accion) {
        case 'listar':
            echo "<h2>Lista de Libros Actual:</h2>";
            mostrarLibros($libros);
            break;

        case 'agregar':
            $titulo = $_POST['titulo'] ?? '';
            $autor = $_POST['autor'] ?? '';

            if ($titulo && $autor) {
                agregarLibro($libros, $titulo, $autor);
                echo "<h2>Libro Agregado Correctamente:</h2>";
                echo "Título: " . htmlspecialchars($titulo) . "<br>";
                echo "Autor: " . htmlspecialchars($autor) . "<br>";
                echo "<hr>";
                echo "<h3>Lista Actualizada:</h3>";
                mostrarLibros($libros);
            } else {
                echo "<h2>Error: Título y/o autor no proporcionados.</h2>";
            }
            break;

        case 'buscar':
            $tituloBuscar = $_POST['tituloBuscar'] ?? '';
            
            if ($tituloBuscar) {
                $buscado = buscarLibro($libros, $tituloBuscar);

                echo "<h2>Resultado de Búsqueda ('" . htmlspecialchars($tituloBuscar) . "'):</h2>";
                if ($buscado) {
                    echo "Libro encontrado:" . $buscado["titulo"] . "de" . $buscado["autor"] . "<br>";
                } else {
                    echo "Libro no encontrado en la biblioteca.<br>";
                }
            } else {
                echo "<h2>Error: Título de búsqueda no proporcionado.</h2>";
            }
            break;

        default:
            echo "<h2>Acción desconocida.</h2>";
            break;
    }

} else {
    echo "<h2>Bienvenido a la Gestión de Biblioteca. Por favor, seleccione una acción desde el formulario.</h2>";
}

echo "<hr>";
echo "<form action='Ejercicio5.html' method='get'>";
echo "<input type='submit' value='Volver al Formulario Principal'>";
echo "</form>";

echo "</body>
</html>";
?>