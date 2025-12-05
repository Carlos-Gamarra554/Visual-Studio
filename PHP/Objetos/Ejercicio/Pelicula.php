<?php

class Pelicula extends Producto {
    public function __construct(private string $precioAlquiler) {
        parent::__construct("Pelicula", $precioAlquiler);
    }
}

?>