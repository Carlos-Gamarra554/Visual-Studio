<?php 
$titulo_pagina = "Nuestras Habitaciones";
include 'includes/header.php'; 
?>

<section class="hero-section hero-habitaciones">
    <div class="hero-contenido">
        <h1>Descanso y <span class="resalto">Lujo</span></h1>
        <p class="hero-subtitulo">ENCUENTRA TU REFUGIO PERFECTO</p>
    </div>
</section>

<section class="habitaciones-section">
    <div class="habitaciones-contenedor">
        
        <div class="texto-centrado">
            <h2 class="habitaciones-titulo">Todas nuestras Suites</h2>
            <p class="texto-descripcion">Cada una de nuestras habitaciones ha sido diseñada pensando en su máximo confort. Disfrute de vistas inigualables y un servicio de habitaciones 24 horas.</p>
        </div>
        
        <div class="habitaciones-grid">
            
            <article class="tarjeta-habitacion">
                <div class="imagen-habitacion">
                    <img src="img/habitacion1.jpg" alt="Habitación Deluxe">
                </div>
                <div class="info-habitacion">
                    <h3>Habitación Deluxe</h3>
                    <p class="desc-habitacion">Vistas al mar y jacuzzi privado.</p>
                    <div class="detalles-habitacion">
                        <span><i class='bx bx-bed'></i> 1 King</span>
                        <span><i class='bx bxs-user'></i> 2 Pers.</span>
                        <span class="precio-habitacion">350€/noche</span>
                    </div>
                    <a href="#" class="btn btn-primary btn-reservar">Reservar</a>
                </div>
            </article>

            <article class="tarjeta-habitacion">
                <div class="imagen-habitacion">
                    <img src="img/habitacion2.jpg" alt="Habitación Estándar">
                </div>
                <div class="info-habitacion">
                    <h3>Habitación Estándar</h3>
                    <p class="desc-habitacion">Comodidad y elegancia funcional.</p>
                    <div class="detalles-habitacion">
                        <span><i class='bx bx-bed'></i> 2 Queen</span>
                        <span><i class='bx bxs-user'></i> 3 Pers.</span>
                        <span class="precio-habitacion">200€/noche</span>
                    </div>
                    <a href="#" class="btn btn-primary btn-reservar">Reservar</a>
                </div>
            </article>

            <article class="tarjeta-habitacion">
                <div class="imagen-habitacion">
                    <img src="img/habitacion3.jpg" alt="Habitación Doble">
                </div>
                <div class="info-habitacion">
                    <h3>Suite Familiar</h3>
                    <p class="desc-habitacion">Espacio amplio para toda la familia.</p>
                    <div class="detalles-habitacion">
                        <span><i class='bx bx-bed'></i> 3 Camas</span>
                        <span><i class='bx bxs-user'></i> 5 Pers.</span>
                        <span class="precio-habitacion">450€/noche</span>
                    </div>
                    <a href="#" class="btn btn-primary btn-reservar">Reservar</a>
                </div>
            </article>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>