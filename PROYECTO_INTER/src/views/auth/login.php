<a href="index.php" class="btn-volver">
    <i class='bx bx-arrow-back'></i> Volver
</a>

<div class="login-contenedor">
    <div class="tarjeta-login">
        <h2>Bienvenido de nuevo</h2>

        <?php if(isset($_SESSION['error_login'])): ?>
            <div>
                <?php 
                    echo $_SESSION['error_login']; 
                    unset($_SESSION['error_login']);
                ?>
            </div>
        <?php endif; ?>
        
        <p class="subtitulo-login">Accede a tu cuenta</p>

        <form action="index.php?tabla=auth&accion=validar" method="POST" class="formulario-login">
            
            <div class="campo-input">
                <label>Correo Electrónico</label>
                <div class="input-con-icono">
                    <i class='bx bx-envelope'></i>
                    <input type="email" name="email" placeholder="ejemplo@correo.com" required>
                </div>
            </div>

            <div class="campo-input">
                <label>Contraseña</label>
                <div class="input-con-icono">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>

        <div class="pie-login">
            <p>¿No tienes cuenta? <a href="index.php?tabla=usuarios&accion=crear">Regístrate aquí</a></p>
        </div>
    </div>
</div>