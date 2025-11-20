<!--Importamos los datos de los otros ficheros-->
<?php include("datos.php") ?>
<?php include("utiles.php") ?>
<?php include("categorias.php") ?>

<!--Borrar el último proyecto si encuentra el argumento delete en la URL-->
<?php
    //Convertimos las fechas de los proyectos
    $proyectos = convertirFechas($proyectos);

    if(isset($_GET['delete']) && $_GET['delete'] == true) {
    $proyectos = borrarUltimoProyecto($proyectos);
}

    $proyectos_mostrar = $proyectos;

    //Extraemos el id de la categoría seleccionada y filtramos los proyectos que pertenecen a dicha categoría
    if (isset($_GET['categoria_id'])) {
    $proyectos_mostrar = filtrarProyectosPorCategoria($proyectos, $_GET['categoria_id']);
}

//Código para ordenar los proyectos por nombre ascendente o descendentemente
if (isset($_GET['orden'])) {
    ordenarProyectosPorNombre($proyectos_mostrar, $_GET['orden']);
}

//Ordenación por fecha según el parámetro recibido en la URL
if (isset($_GET['sort_date']) && ($_GET['sort_date'] == '1' || $_GET['sort_date'] == '-1')) {
    ordenarProyectosPorFecha($proyectos_mostrar, $_GET['sort_date']);
}
?>

<!--Insertamos la cabecera de la página-->
<?php include("templates/header.php") ?>

<!--Botones para ordenar de manera ascendente o descendente-->
<div class="container mb-5">
    <div class="row mb-4">
    <div class="col-12">

        <?php
        //Recoger los datos de la URL
        $query_params = $_GET;

        //Recoger información para ordenación por nombre y borrar ordenación
        //por fecha para que no se sobrepongan
        $query_params_nombre = $query_params;
        unset($query_params_nombre['sort_date']);

        //Crear las URLs para los enlaces de ordenación
        $query_params_nombre['orden'] = 'asc';
        $url_nombre_asc = 'index.php?' . http_build_query($query_params_nombre);
        $query_params_nombre['orden'] = 'desc';
        $url_nombre_desc = 'index.php?' . http_build_query($query_params_nombre);

        //Recoger información para ordenación por fecha y borrar ordenación
        //por nombre para que no se sobrepongan
        $query_params_fecha = $query_params;
        unset($query_params_fecha['orden']);

        //Crear las URLs para los enlaces de ordenación
        $query_params_fecha['sort_date'] = '1';
        $url_fecha_asc = 'index.php?' . http_build_query($query_params_fecha);
        $query_params_fecha['sort_date'] = '-1';
        $url_fecha_desc = 'index.php?' . http_build_query($query_params_fecha);

        //Restablecer los filtros
        $query_params_reset = $query_params;
        unset($query_params_reset['orden']);
        unset($query_params_reset['sort_date']);
        $url_reset = 'index.php';

        if(!empty($query_params_reset)){
            $url_reset = 'index.php?' . http_build_query($query_params_reset);
        }
        ?>

    <!--Ejercicio 2. a) Botón para crear proyecto-->
    <?php if(loggedIn()): ?>
    <div class="mb-4">
        <a href="nuevo_proyecto.php" class="btn btn-outline-primary btn-sm mr-2">
            Crear proyecto
        </a>
    </div>
    <?php endif; ?>

    <!--Botones de ordenación por fecha y por nombre-->
    <div class="mb-4">
        <span class="mr-2">Ordenación:</span>
        <a href="<?php echo $url_nombre_asc; ?>" class="btn btn-outline-primary btn-sm mr-2">
            Nombre ascendente (A-Z)
        </a>
        <a href="<?php echo $url_nombre_desc; ?>" class="btn btn-outline-primary btn-sm mr-2">
            Nombre descendente (Z-A)
        </a>
        <a href="<?php echo $url_fecha_asc; ?>" class="btn btn-outline-primary btn-sm mr-2">
            Fecha ascendente
        </a>
        <a href="<?php echo $url_fecha_desc; ?>" class="btn btn-outline-primary btn-sm mr-2">
            Fecha descendente
        </a>

        <a href="<?php echo $url_reset; ?>" class="btn btn-outline-secondary btn-sm">
            Restablecer
        </a>
    </div>

    <?php if (isset($_GET['logout']) && $_GET['logout'] == 'true'): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ¡Has cerrado sesión correctamente! Esperamos verte pronto.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>

<!--Recorremos todos los proyectos y extremos su información para mostrarla-->
<div class="row">
    <?php foreach($proyectos_mostrar as $proyecto): ?>
        <div class="col-sm-3 mb-4">
                <div class="card h-100">

                    <!--Extraemos la imagen del proyecto y, si no la encuentra, pone la de por defecto-->
                    <?php $imagen = obtenerImagenProyecto($proyecto['imagen']); ?>

                    <!--Extraemos la clave para referenciar al proyecto en la imagen-->
                    <a href="proyecto.php?clave=<?php echo $proyecto['clave']; ?>">
                        <!--Creamos la tarjeta con la imagen devuelta-->
                        <img class="card-img-top" src="<?php echo $imagen; ?>" alt="<?php echo $proyecto['titulo']; ?>">
                    </a>
                    
                    <!--Ponemos el título enlazado al proyecto y la descrición del mismo-->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="proyecto.php?clave=<?php echo $proyecto['clave']; ?>">
                                <?php echo $proyecto['titulo']; ?>
                            </a>
                        </h5>
                        <p class="card-text"><?php echo $proyecto['descripcion']; ?></p>

                    <!--Mostrar la fecha del proyecto-->
                    <p class="card-text small text-muted"><?php echo "Fecha proyecto: " . date('d/m/Y', $proyecto['fecha']); ?></p>

                    <!--Recorremos las categorías e imprimimos los nombres de estas-->
                    <p class="mt-auto">
                        <small>
                            <?php foreach ($proyecto['categorias'] as $id_categoria) {
                                $nombre_categoria = obtenerNombreCategoria($id_categoria, $categorias);
                                echo '<span class="badge badge-primary mr-1">' . $nombre_categoria . '</span>';
                            } ?>
                        </small>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>    
</div>

<!--Insertamos el pie de página-->
<?php include("templates/footer.php") ?>    