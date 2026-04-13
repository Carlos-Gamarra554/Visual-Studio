<?php
require_once "controllers/usersController.php";

// Si no hay ID, volvemos al listado o al inicio
if (!isset($_REQUEST['id'])) {
    header("location:index.php?tabla=usuarios&accion=listar");
    exit();
}

$id = $_REQUEST['id'];
$controlador = new UsersController();
$user = $controlador->ver($id);

// Si el usuario no existe en BBDD, redirigimos
if ($user == null) {
    header("location:index.php?tabla=usuarios&accion=listar");
    exit();
}

// Incluimos la cabecera del proyecto
require 'views/layout/header.php';
?>

<section class="seccion-perfil">
    <div class="contenedor-perfil">
        
        <div class="cabecera-perfil">
            <h1 class="titulo-perfil">Ficha de Usuario</h1>
        </div>

        <div class="tarjeta-perfil">
            <h2 class="titulo-tarjeta">
                <i class='bx bxs-id-card' style="color:#4F7BB2;"></i> 
                ID: <?= $user->id ?>
            </h2>
            
            <div class="grid-datos">
                
                <div class="bloque-dato">
                    <strong class="etiqueta-dato">Nombre Completo:</strong>
                    <p class="valor-dato"><?= $user->nombre ?></p>
                </div>

                <div class="bloque-dato">
                    <strong class="etiqueta-dato">Email:</strong>
                    <p class="valor-dato"><?= $user->email ?></p>
                </div>

                <div class="bloque-dato">
                    <strong class="etiqueta-dato">Rol:</strong>
                    <span class="badge-rol" style="background:#4F7BB2; color:white; padding: 2px 8px; border-radius:4px;">
                        <?= isset($user->rol) ? strtoupper($user->rol) : 'USUARIO' ?>
                    </span>
                </div>
                
            </div>

            <div style="margin-top: 2rem; display: flex; gap: 15px;">
                <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
                
                <a href="index.php?tabla=usuarios&accion=listar" class="btn" style="background-color:#666; color:white; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Ver Listado</a>
            </div>

        </div>
    </div>
</section>

<?php 
// Incluimos el pie de página
require 'views/layout/footer.php'; 
?>