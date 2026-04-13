<?php include 'includes/header.php'; ?>

<section class="hero-section hero-contacto">
    <div class="hero-contenido">
        <h1>Contáctanos</h1>
    </div>
</section>

<section class="seccion-contacto">
    <div class="contenedor-contacto">
        
        <div class="columna-info">
            <h2 class="titulo-contacto">Estamos aquí para ayudarte</h2>
            <p class="texto-descripcion" style="margin-bottom: 2rem;">
                ¿Tienes dudas sobre tu reserva o quieres organizar un evento especial? Escríbenos y nuestro equipo te responderá en menos de 24 horas.
            </p>
            
            <div class="bloque-dato">
                <h4>📍 Dirección</h4>
                <p class="texto-descripcion">C/ Vicente Blasco, 7, Alicante</p>
            </div>
            
            <div class="bloque-dato">
                <h4>📞 Teléfono</h4>
                <p class="texto-descripcion">+34 123 456 789</p>
            </div>

            <div class="bloque-dato">
                <h4>✉️ Email</h4>
                <p class="texto-descripcion">info@lunazul.com</p>
            </div>
        </div>

        <div class="columna-form">
            <div class="tarjeta-contacto">
                <h3 style="margin-bottom: 1.5rem; color: #1A2B49;">Envíanos un mensaje</h3>
                
                <form action="#" method="POST">
                    <div class="campo-input">
                        <label>Nombre Completo</label>
                        <input type="text" class="input-contacto" placeholder="Tu nombre">
                    </div>
                    
                    <div class="campo-input">
                        <label>Correo Electrónico</label>
                        <input type="email" class="input-contacto" placeholder="tucorreo@ejemplo.com">
                    </div>

                    <div class="campo-input">
                        <label>Mensaje</label>
                        <textarea rows="4" class="textarea-contacto" placeholder="¿En qué podemos ayudarte?"></textarea>
                    </div>

                    <button type="submit" class="btn-login">Enviar Mensaje</button>
                </form>
            </div>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>