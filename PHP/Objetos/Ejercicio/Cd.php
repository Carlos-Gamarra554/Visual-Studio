<?php
require_once 'Producto.php';

class Cd extends Producto {
    public function getPrecio() {
        return 1;
    }
}

?>