<?php

class Pelicula extends Producto {
    public function __construct(private string $precioAlquiler = 2) {
        parent::__construct("Pelicula", $precioAlquiler);
    }
}

?>