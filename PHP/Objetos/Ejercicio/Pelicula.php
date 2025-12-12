<?php
require_once 'Producto.php';

class Pelicula extends Producto {
    public function getPrecio() {
        return 2;
    }
}

?>