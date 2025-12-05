<?php
class Operacion {
  protected int $valor1;
  protected int $valor2;
  protected int $resultado;
  public function __construct($v1,$v2)
  {
    $this->valor1=$v1;
    $this->valor2=$v2;
  }
  public final function imprimirResultado()
  {
    echo $this->resultado.'<br>';
  }
}

final class Suma extends Operacion{
  private string $titulo;
  public function __construct(int $v1,int $v2,string $tit)
  {
    parent::__construct( $v1, $v2);
    $this->titulo=$tit;
  }
  public function operar()
  {
    echo $this->titulo;
    echo $this->valor1.'+'.$this->valor2.' es ';
    $this->resultado=$this->valor1+$this->valor2;
  }
}

$suma=new Suma(10,10,'Suma de valores:');
$suma->operar();
$suma->imprimirResultado();
?>