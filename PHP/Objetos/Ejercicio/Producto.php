<?php

public abstract class Producto {
    public function __construct(private string $nombre, private float $precio) {}

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getPrecio(): float {
        return $this->precio;
    }
}

?>