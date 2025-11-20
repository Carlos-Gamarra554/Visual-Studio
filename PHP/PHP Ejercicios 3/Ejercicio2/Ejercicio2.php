<?php
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];

$total = $cantidad * $precio;

if ($cantidad >= 0 && $cantidad <= 10) {
    $descuento = 0;
} elseif ($cantidad <= 30) {
    $descuento = 0.05;
} elseif ($cantidad <= 50) {
    $descuento = 0.10;
} else {
    $descuento = 0.15;
}

$totalConDescuento = $total - ($total * $descuento);

echo "Cantidad: $cantidad<br>";
echo "Precio unitario: $precio €<br>";
echo "Descuento aplicado: " . ($descuento * 100) . "%<br>";
echo "Total a pagar: " . number_format($totalConDescuento, 2) . " €";
?>
