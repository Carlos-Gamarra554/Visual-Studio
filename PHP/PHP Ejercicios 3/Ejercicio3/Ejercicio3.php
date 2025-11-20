<?php
$n = $_POST["n"];

$a = 0;
$b = 1;

echo "Los $n primeros términos de la serie de Fibonacci son:<br>";

for ($i = 0; $i < $n; $i++) {
    echo $a . " ";
    $siguiente = $a + $b;
    $a = $b;
    $b = $siguiente;
}
?>
