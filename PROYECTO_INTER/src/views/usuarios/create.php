<a href="index.php" class="btn-volver">
    <i class='bx bx-arrow-back'></i> Volver
</a>

<div class="login-contenedor" style="margin-top: 50px; margin-bottom: 50px;">
    
    <div class="tarjeta-login">
        <h2>Crear Cuenta Nueva</h2>
        <p class="subtitulo-login">Únete a Lunazul para gestionar tus reservas</p>
        
        <?php
            $data = isset($_SESSION["datos"]) ? $_SESSION["datos"] : [];
            $errores = isset($_SESSION["errores"]) ? $_SESSION["errores"] : [];
        ?>

        <form action="index.php?tabla=usuarios&accion=guardar" method="POST" class="formulario-login">
            
            <div class="campo-input">
                <label>Nombre Completo</label>
                <div class="input-con-icono">
                    <i class='bx bx-id-card'></i>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($data["nombre"] ?? "") ?>" required>
                </div>
                <?php if (isset($errores["nombre"])): ?>
                    <div style="color:#c62828; font-size:0.8rem; margin-top:5px;"><?= $errores["nombre"][0] ?></div>
                <?php endif; ?>
            </div>

            <div class="campo-input">
                <label>Correo Electrónico</label>
                <div class="input-con-icono">
                    <i class='bx bx-envelope'></i>
                    <input type="email" name="email" value="<?= htmlspecialchars($data["email"] ?? "") ?>" required>
                </div>
                <?php if (isset($errores["email"])): ?>
                    <div style="color:#c62828; font-size:0.8rem; margin-top:5px;"><?= $errores["email"][0] ?></div>
                <?php endif; ?>
            </div>

            <div class="campo-input">
                <label>Contraseña</label>
                <div class="input-con-icono">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" name="password" required>
                </div>
                <?php if (isset($errores["password"])): ?>
                    <div style="color:#c62828; font-size:0.8rem; margin-top:5px;"><?= $errores["password"][0] ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn-login">Registrarse</button>
        </form>

        <div class="pie-login">
            <p>¿Ya tienes cuenta? <a href="index.php?tabla=auth&accion=login">Inicia sesión</a></p>
        </div>
        
        <?php
            // Limpiamos errores tras mostrarlos
            unset($_SESSION["datos"]);
            unset($_SESSION["errores"]);
        ?>
    </div>
</div>