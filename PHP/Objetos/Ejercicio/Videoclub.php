<?php

class Videoclub {
    public function __construct(private string $nombre, private array $clientes, private array $productos) {}

    public function alquilarProducto($cliente, $producto) {
        return "El cliente {$cliente->nombre} ha alquilado el producto {$producto->titulo} del videoclub {$this->nombre}.";
    }

    agregarProducto($producto) {
        $this->productos[] += $producto;
    }

    agregarCliente($cliente) {
        $this->clientes[] += $cliente;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getClientes(): array {
        return $this->clientes;
    }

    public function getProductos(): array {
        return $this->productos;
    }
}

?>