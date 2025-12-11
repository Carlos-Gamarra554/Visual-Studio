<?php

class Pelicula extends Producto {
    public function __construct(private string $precioAlquiler = 1) {
        parent::__construct("Cd", $precioAlquiler);
    }
}

?>