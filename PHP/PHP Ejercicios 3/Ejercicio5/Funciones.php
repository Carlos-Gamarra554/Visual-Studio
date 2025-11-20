<?php
function mostrarLibros($libros) {
    foreach ($libros as $libro) {
        echo $libro["titulo"] . " - " . $libro["autor"] . "<br>";
    }
}

function agregarLibro(&$libros, $titulo, $autor) {
    $libros[] = ["titulo" => $titulo, "autor" => $autor];
}

function buscarLibro($libros, $tituloBuscado) {
    $tituloBuscadoLower = mb_strtolower($tituloBuscado, 'UTF-8');

    foreach ($libros as $libro) {
        if (mb_strtolower($libro["titulo"], 'UTF-8') === $tituloBuscadoLower) {
            return $libro;
        }
    }
    return null;
}

function contarLibros($libros) {
    return count($libros);
}
?>