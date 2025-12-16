<?php
require_once 'Producto.php';

class Cd extends Producto {
    private $duracion;
    private $genero;

    public function __construct($nombre, $duracion, $genero) {
        parent::__construct($nombre, 1);
        
        $this->duracion = $duracion;
        $this->genero = $genero;
    }

    public function getResumen() {
        return "Duración: {$this->duracion} min, Género: {$this->genero}";
    }
}

?>