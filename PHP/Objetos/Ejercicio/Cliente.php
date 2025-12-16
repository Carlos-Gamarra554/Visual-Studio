<?php
require_once 'Producto.php';

class Cliente {
    protected $nombre;
    protected $productosAlquilados = [];

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function agregarAlquiler(Producto $p) {
        $this->productosAlquilados[] = $p;
    }

    public function listarAlquileres() {
        echo "<strong>Alquileres de " . $this->nombre . ":</strong><br>";

        if (empty($this->productosAlquilados)) {
            echo "-No tiene alquileres.<br>";
        } else {
            foreach ($this->productosAlquilados as $producto) {
                echo get_class($producto) . ": " . $producto->getNombre() . "-> " . $producto->getPrecio() . "€<br>";
            }
        }
        echo "<br>";
    }
}
?>