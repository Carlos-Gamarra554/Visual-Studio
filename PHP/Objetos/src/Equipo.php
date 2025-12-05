<?php
require_once "Saiyajin.php";//si quitas el once, que pasaría??? ahhhh
require_once "SuperGuerrer.php";

class Equipo {
    public function __construct (private Saiyajin $saiyajin1, private Saiyajin $saiyajin2,private SuperGuerrer $superGuerrer1){}

    public function getSaiyajin1():Saiyajin
    {
        return $this->saiyajin1;
    }

    public function setSaiyajin1(Saiyajin $s1)
    {
        $this->saiyajin1=$s1;
    }

    public function ImprimirEquipo(){
            echo "Saiyajin1: {$this->saiyajin1->getNombre()}<br>";
            echo "Saiyajin2: {$this->saiyajin2->getNombre()}<br>";
            echo "SuperGuerrer: {$this->superGuerrer1->getNombre()}<br>";
    }
}