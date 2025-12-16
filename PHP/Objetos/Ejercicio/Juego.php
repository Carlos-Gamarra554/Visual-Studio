<?php
require_once 'Producto.php';

class Juego extends Producto {
    private $plataforma;
    private $genero;

    public function __construct($nombre, $plataforma, $genero) {
        parent::__construct($nombre, 3);
        
        $this->plataforma = $plataforma;
        $this->genero = $genero;
    }

    public function getResumen() {
        return "Plataforma: {$this->plataforma}, Género: {$this->genero}";
    }
}

?>