<?php

class Saiyajin{
    protected string $nombre;
    protected int $nivel;
    protected string $clase="Saiyajin";

    public function __construct (string $nombre,int  $nivel=10)
    {
        $this->nombre=$nombre;
        $this->nivel=$nivel;
    }
    
    public function Saludar():string{
        return "Hola soy {$this->nombre}";
    }
    
    public function Nivel():string{
        return "{$this->nombre} es de nivel: {$this->nivel} ";
    }

    public function getClase():string{
        return $this->clase;
    }

    public function getNombre():string{
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre=$nombre;
    }
}