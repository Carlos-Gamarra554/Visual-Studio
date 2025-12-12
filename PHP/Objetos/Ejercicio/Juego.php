<?php
require_once 'Producto.php';

class Juego extends Producto {
    public function getPrecio() {
        return 3;
    }
}

?>