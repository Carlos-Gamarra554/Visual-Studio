<?php

class Digimon {
    public function __construct(public string $nombre, string $tipo, public int $ataque, public int $defensa, public int $nivel = 1)
    {}

    public function saludar(): string {
        return "Soy {$this->nombre}, tipo {$this->tipo}.";
    }

    public function poderTotal(): int {
        return $this->ataque + $this->defensa;
    }

    public function combatir(Digimon $enemigo): string {
        if ($this->poderTotal() > $enemigo->poderTotal()) {
            return "{$this->nombre} vence a {$enemigo->nombre}!";
        } else if ($this->poderTotal() < $enemigo->poderTotal()) {
            return "{$this->nombre} pierde contra {$enemigo->nombre}.";
        } else {
            return "{$this->nombre} y {$enemigo->nombre} empatan.";
        }
    }

    public function __clone() {
        $this-> 
    }
}

class DigimonTipoPlanta extends Digimon {
    public function __construct(public string $nombre, string $tipo, public int $ataque, public int $defensa, public int $nivel = 1, public array $ataquesPlanta = [], public int $altura) {
        parent::__construct($nombre, $tipo, $ataque, $defensa, $nivel);
        $this->ataquesPlanta=$ataquesPlanta;
        $this->altura=$altura;
    }

    public function subirAtaque() {
        if ($tipo = "virus")
    }
}
?>
