<?php
$noches = $_POST["noches"];
$tipoHabitacion = $_POST["tipo"];
$precio = 0;

if ($noches > 2 and $tipoHabitacion == "I") {
    $precio = 34.34;
} elseif ($noches > 2 and $tipoHabitacion == "D") {
    $precio = 36.78;
} elseif ($noches <= 2 and $tipoHabitacion == "I") {
    $precio = 32.15;
} elseif ($noches <= 2 and $tipoHabitacion == "D") {
    $precio = 35.54;
}

$total = $precio * $noches;

print("<h1>Precio total de la reserva</h1>");

if ($noches <= 0) {
    print("Escoge al menos una noche para la reserva.");
} else {
    print("El precio total es de: $total € ($precio € por noche)");
}

print("<br><br><a href='Ejercicio1.html'>Volver al formulario</a>");
?>