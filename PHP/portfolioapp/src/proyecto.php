<!--Inclusión de ficheros-->
<?php include("datos.php"); ?>
<?php include("categorias.php"); ?>
<?php include("utiles.php"); ?>
<?php include("templates/header.php"); ?>

<?php
//Convertimos las fechas de los proyectos
$proyectos = convertirFechas($proyectos);

// Buscamos 'clave' en la URL
if (isset($_GET['clave']) && !empty($_GET['clave'])) {
    $clave_proyecto = $_GET['clave'];
    $proyecto_actual = null;

    // Buscamos el proyecto que coincida con la clave recibida
    foreach ($proyectos as $proyecto) {
        // Comparamos usando 'clave'
        if ($proyecto['clave'] == $clave_proyecto) {
            $proyecto_actual = $proyecto;
            break; 
        }
    }
}
?>

<!--Estructura del proyecto-->
<div class="container mb-5">
    <?php if (isset($proyecto_actual)) { ?>

    <!--Título del proyecto-->
    <h2 class="mb-3"><?php echo $proyecto_actual['titulo']; ?></h2>
    <hr>

    <div class="row">
        <div class="col-sm">
            <!--Se busca la imagen del proyecto y si no, se pone la default-->
            <?php
                $imagen = obtenerImagenProyecto($proyecto_actual['imagen']);
            ?>
            <img src="<?php echo $imagen; ?>" alt="<?php echo $proyecto_actual['titulo']; ?>" class="img-fluid rounded shadow mb-3"><br>
        </div>

        <div class="col-md-4 d-flex flex-column">
            <h4>Descripción</h4>
            <p><?php echo $proyecto_actual['descripcion']; ?></p>

            <div class="mt-auto">
                    <small>
                    CATEGORÍAS:
                    <?php foreach ($proyecto['categorias'] as $id_categoria) {
                            $nombre_categoria = obtenerNombreCategoria($id_categoria, $categorias);
                            echo '<span class="badge badge-primary mr-1">' . $nombre_categoria . '</span>';
                    }?>
                </small>
            </div>
            
            <!--Mostrar la fecha del proyecto-->
            <p class="card-text small text-muted mt-3">
                <i class="fa-regular fa-calendar me-2"></i>
                <?php echo "Fecha proyecto: " . date('d/m/Y', $proyecto_actual['fecha']); ?>
            </p>

            <!--Actividad 2. b) Botón de edición solo visible para los administradores-->
            <?php if(loggedIn()): ?>
                <div class="mt-4">
                    <a href="nuevo_proyecto.php?clave=<?php echo $proyecto_actual['clave']; ?>" class="btn btn-primary btn-lg w-100 shadow-sm">
                        <i class="fa-solid fa-pen-to-square me-2"></i> Editar Proyecto
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!--Advertencia en caso de que no se encuentre el proyecto-->
    <?php } else { ?>
        <div class="alert alert-danger text-center">
            <h2>Proyecto no encontrado</h2>
            <p>El proyecto que buscas no existe o el enlace es incorrecto.</p>
            <a href="index.php" class="btn btn-primary">Volver al inicio</a>
        </div>
    <?php } ?>
</div>

<?php include("templates/footer.php"); ?>