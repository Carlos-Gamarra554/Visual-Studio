<?php
require_once 'Cliente.php';
require_once 'Producto.php';

class Videoclub {
    private $nombre;
    private $productos = [];
    private $clientes = [];

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function alquilarProducto(Cliente $c, Producto $p) {
        $c->agregarAlquiler($p);
        echo $c->getNombre() . " ha alquilado el producto " . $p->getNombre() . ".<br>";
    }

    public function agregarProducto(Producto $p) {
        $this->productos[] = $p; 
    }

    public function agregarCliente(Cliente $c) {
        $this->clientes[] = $c;
    }

    public function mostrarProductos() {
        echo "<h3>Catálogo de Productos:</h3>";
        foreach ($this->productos as $p) {
            echo "[" . get_class($p) . "] " . $p->getNombre() . ": " . $p->getPrecio() . "€<br>
            -" . $p->getResumen() . "<br><br>";
        }
        echo "<hr>";
    }
    
    public function mostrarClientes() {
        echo "<h3>Clientes registrados:</h3>";
        foreach ($this->clientes as $c) {
            echo "- " . $c->getNombre() . "<br>";
        }
        echo "<hr>";
    }
}

?>