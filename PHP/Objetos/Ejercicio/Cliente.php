<?php

class Cliente {
    public function __construct(private string $nombre, private array $productos) {}
}

public function getNombre(): string {
    return $this->nombre;
}

public function getProductos(): array {
    return $this->productos;
}
?>