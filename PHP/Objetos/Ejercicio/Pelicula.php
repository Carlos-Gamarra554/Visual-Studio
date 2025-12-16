<?php
require_once 'Producto.php';

class Pelicula extends Producto {
    private $idioma;
    private $duracion;
    private $genero;

    public function __construct($nombre, $idioma, $duracion, $genero) {
        parent::__construct($nombre, 2);
        $this->idioma = $idioma;
        $this->duracion = $duracion;
        $this->genero = $genero;
    }

    public function getResumen() {
        return "Idioma: {$this->idioma}, Duración: {$this->duracion} min, Género: {$this->genero}";
    }
}

?>