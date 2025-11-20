<?php
include("utiles.php");
include("templates/header.php");

//Redirigir al login si no se está logueado
if (!loggedIn()) {
    header("Location: login.php?error=acceso");
    exit();
}

$clave = isset($_GET['clave']) ? $_GET['clave'] : '';
$operacion = isset($_GET['operacion']) ? $_GET['operacion'] : 'procesado';
?>

<div class="container mt-5 text-center">
    <div class="card shadow-sm p-5">
        <div class="card-body">
            <div class="display-1 text-success mb-4">
                <i class="fa-regular fa-circle-check"></i>
            </div>
            <!--Mensaje de operación realizada exitosamente-->
            <h2 class="mb-3">Operación realizada con éxito</h2>
            <p class="lead">
                El proyecto <strong><?php echo htmlspecialchars($clave); ?></strong>
                ha sido <?php echo htmlspecialchars($operacion); ?> correctamente.
            </p>

            <hr class="my-4">

            <div class="d-flex justify-content-center gap-3">
                <!--Botón para ir a la ficha del proyecto-->
                <a href="proyecto.php?clave=<?php echo $clave; ?>" class="btn btn-primary btn-lg me-2">
                    <i class="fa-solid fa-eye me-2"></i> Ver Proyecto
                </a>

                <!--Botón para volver al inicio-->
                 <a href="index.php" class="btn btn-outline-secondary btn-lg">
                    <i class="fa-solid fa-house me-2"></i> Volver al Inicio
                 </a>
            </div>
        </div>
    </div>
</div>

<?php include("templates/footer.php"); ?>