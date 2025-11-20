<?php
$adultos = $_POST["adultos"];
$precioAdulto = $_POST["precioAdulto"];
$infantiles = $_POST["infantiles"];
$precioInfantil = $_POST["precioInfantil"];

$totalBruto = ($adultos * $precioAdulto) + ($infantiles * $precioInfantil);
$impuesto = $totalBruto * 0.06;
$servicio = $totalBruto * 0.02;

$totalFinal = $totalBruto + $impuesto + $servicio;

echo "<h3>Resumen del pedido</h3>";
echo "Entradas de adulto: $adultos x $precioAdulto €<br>";
echo "Entradas infantiles: $infantiles x $precioInfantil €<br>";
echo "Subtotal: " . number_format($totalBruto, 2) . " €<br>";
echo "Impuesto (6%): " . number_format($impuesto, 2) . " €<br>";
echo "Coste de servicio (2%): " . number_format($servicio, 2) . " €<br>";
echo "<strong>Total a pagar: " . number_format($totalFinal, 2) . " €</strong>";
?>
