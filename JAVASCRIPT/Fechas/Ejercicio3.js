const reservas = [
 { nombre: "Ana", fecha: new Date("2025-12-25") },
 { nombre: "Luis", fecha: new Date("2025-01-01") },
 { nombre: "María", fecha: new Date("2025-09-10") },
 { nombre: "Carlos", fecha: new Date("2025-06-30") },
 { nombre: "Sofía", fecha: new Date("2025-03-15") }
];

reservas.sort((a, b) => a.fecha - b.fecha);
console.log("Reservas ordenadas por fecha:");
reservas.forEach((reserva, index) => {
    console.log(
    `Reserva ${index + 1}: ${reserva.nombre} - ${reserva.fecha.toDateString()}`
 );
});