<?php
require_once "Saiyajin.php";

class SuperGuerrer extends Saiyajin{
    public string $clase="Super Guerrer";
    
    public function Transformacion():string
    {
        $texto= ($this->nivel>1500)?"{$this->nombre} se transforma en {$this->clase}":"{$this->nombre} NO se transforma en {$this->clase}";
        
        return $texto;
    }

    public function Saludar():string{
        $saludo= parent::Saludar() . " y soy {$this->clase}" ;
        return $saludo;
    }
    
    public function Nivel():string{
        $nivel=$this->nivel*2;
        return "{$this->nombre} es de nivel: {$nivel}";
    }
}