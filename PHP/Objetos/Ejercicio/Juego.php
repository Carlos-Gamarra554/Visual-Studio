<?php

class Juego extends Producto {
    public function __construct(private string $precioAlquiler = 3) {
        parent::__construct("Juego", $precioAlquiler);
    }
}

?>