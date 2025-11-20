<?php
include("utiles.php");
include("datos.php");

$proyectos = convertirFechas($proyectos);

//Redirigir a inicio de sesión con error si no está logueado
if (!loggedIn()) {
    header("Location: login.php?error=acceso");
    exit();
}

//Inicializar variables
$clave = "";
$titulo = "";
$fecha = "";
$descripcion = "";
$imagen_actual = "";
$clave_original = "";
$modo_edicion = false;

//Inicializar variables de errores
$claveErr = "";
$tituloErr = "";
$fechaErr = "";
$descErr = "";
$imgErr = "";

//Comprobar si estamos editando o no
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['clave'])) {
    $clave_proyecto = $_GET['clave'];

    //Buscamos el proyecto en el array y extraemos su información
    foreach ($proyectos as $proyecto) {
        if ($proyecto['clave'] == $clave_proyecto) {
            $clave = $proyecto['clave'];
            $clave_original = $proyecto['clave'];
            $titulo = $proyecto['titulo'];
            $descripcion = $proyecto['descripcion'];
            $fecha = date('d/m/Y', $proyecto['fecha']);
            $imagen_actual = $proyecto['imagen'];
            $modo_edicion = true;
        }
    }
}

//Procesar el formulario para añadir un proyecto mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Comprobar si estamos editando o no
    $clave_original = isset($_POST['clave_original']) ? $_POST['clave_original'] : "";
    $imagen_actual = isset($_POST['imagen_actual']) ? $_POST['imagen_actual'] : "";
    if (!empty($clave_original)) $modo_edicion = true;

    //Ejercicio 2. d) Sanitizado de los campos con la función
    $clave = test_input($_POST['clave']);
    $titulo = test_input($_POST['titulo']);
    $fecha = test_input($_POST['fecha']);
    $descripcion = test_input($_POST['descripcion']);

    //Validaciones de los campos
    if (empty($clave)) {
        $claveErr = "Por favor, introduzca una clave.";
    } elseif (strpos($clave, ' ') !== false) {
        $claveErr = "La clave no puede contener espacios.";
    }

    if (empty($titulo)) {
        $tituloErr = "Por favor, introduzca un título.";
    }

    if (empty($descripcion)) {
        $descErr = "Por favor, introduzca una descripción.";
    }

    if (empty($fecha)) {
        $fechaErr = "Por favor, introduzca una fecha.";
    } elseif (!preg_match("/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/", $fecha)) {
        $fechaErr = "El formato debe ser DD/MM/YYYY.";
    }

    //Comprobaciones para las imágenes
    $ruta_img = $imagen_actual;

    //Si se ha subido un fichero nuevo se comprueba que sea válido
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $archivo_tmp = $_FILES['imagen']['tmp_name'];
        $nombre_archivo = $_FILES['imagen']['name'];
        $archivo_tamano = $_FILES['imagen']['size'];
        $tipo_archivo = $_FILES['imagen']['type'];

        //Comprobar que se una imagen real
        $check = getimagesize($archivo_tmp);
        if($check === false) {
            $imgErr = "EL archivo no es una imagen válida.";
        } else {
            //Se le crea un nuevo nombre a la imagen para que no se sobrescriba con el de otras
            $nuevo_nombre_img = uniqid() . "_" . basename($nombre_archivo);
            $ruta_img = "static/images/" . $nuevo_nombre_img;

            //Se mueve el fichero a la ruta de las imagenes
            if (!move_uploaded_file($archivo_tmp, $ruta_img)) {
                $imgErr = "Hubo un error al subir una imagen.";
            } else {
                //Si es exitoso y estamos editando, se borra la imagen vieja 
                if ($modo_edicion && !empty($imagen_actual) && file_exists($imagen_actual)) {
                    unlink($imagen_actual);
                }
            }
        }
    }

    //Actividad 2. e) Crear o actualizar el proyecto consultado
    if (empty($claveErr) && empty($tituloErr) && empty($descErr) && empty($fechaErr) && empty($imgErr)) {
        //Convertir la fecha al formato en el que se almacena en el array
        $fechaProyecto = DateTime::createFromFormat('d/m/Y', $fecha);
        $fecha_guardar = $fechaProyecto->format('Y-m-d');

        //Creación de un nuevo proyecto
        $nuevo_proyecto = [
            "clave" => $clave,
            "titulo" => $titulo,
            "descripcion" => $descripcion,
            "fecha" => $fecha_guardar,
            "categorias" => [],
            "imagen" => $ruta_img
        ];

        //Lógica de guardado en el JSON
        $archivo_json = 'mysql/datos_proyectos1.json';
        $contenido_json = file_get_contents($archivo_json);
        $array_proyectos = json_decode($contenido_json, true);

        if($modo_edicion) {
            //Buscar y reemplazar
            $encontrado = false;
            foreach ($array_proyectos as $key => $valor) {
                //Si el proyecto ya existe y solo queremos modificarlo, mantenemos las categorías
                if ($valor['clave'] == $clave_original) {
                    $nuevo_proyecto['categorias'] = $valor['categorias'];
                    $array_proyectos[$key] = $nuevo_proyecto;
                    $encontrado = true;
                    break;
                }
            }
            //Si no se encuentra el proyecto que se está editando, se crea uno nuevo
            if (!$encontrado) {
                array_push($array_proyectos, $nuevo_proyecto);
            }
            //Creación de un nuevo proyecto fuera del modo edición
        } else {
            array_push($array_proyectos, $nuevo_proyecto);
        }

        //Guardamos el nuevo array en el JSON
        file_put_contents($archivo_json, json_encode($array_proyectos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        //Actividad 2. f) Redirigimos a la página de confirmación
        header("Location: confirma_proyecto.php?clave=" . $clave . "&operacion=" . ($modo_edicion ? "editado" : "creado"));
        exit();
    }
}
?>

<?php include("templates/header.php"); ?>

<!--Formulario para crear el proyecto-->
<div class="container mb-5">
    <h2 class="mb-4"><?php echo $modo_edicion ? "Editar Proyecto" : "Nuevo Proyecto" ?></h2>

    <div class="card">
        <div class="card-body">
            <form action="nuevo_proyecto.php" method="POST" enctype="multipart/form-data">

                <!-- Campos ocultos para mantener estado -->
                <input type="hidden" name="clave_original" value="<?php echo $clave_original; ?>">
                <input type="hidden" name="imagen_actual" value="<?php echo $imagen_actual; ?>">

                <!-- Campo para la clave del proyecto -->
                <div class="form-group mb-3">
                    <label class="form-label">Clave del proyecto *</label>
                    <input type="text" name="clave" class="form-control <?php echo !empty($claveErr) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $clave; ?>" <?php echo $modo_edicion ? 'readonly' : ''; ?>>
                    <small class="text-muted">Código único(sin espacios).</small>
                    <!--Imprimir el error si este existe-->
                    <?php if (!empty($claveErr)) : ?><div class="invalid-feedback"><?php echo $claveErr; ?></div><?php endif; ?>
                </div>

                <!-- Campo para el título del proyecto -->
                <div class="form-group mb-3">
                    <label class="form-label">Título *</label>
                    <input type="text" name="titulo" class="form-control <?php echo !empty($tituloErr) ? 'is-invalid' : ''; ?>" value="<?php echo $titulo; ?>">
                    <!--Imprimir el error si este existe-->
                    <?php if (!empty($tituloErr)) : ?><div class="invalid-feedback"><?php echo $tituloErr; ?></div><?php endif; ?>
                </div>

                <!--Campo para la fecha del proyecto-->
                <div class="form-group mb-3">
                    <label class="form-label">Fecha (DD/MM/YYYY) *</label>
                    <input type="text" name="fecha" placeholder="Ej: 25/12/2024" class="form-control <?php echo !empty($fechaErr) ? 'is-invalid' : ''; ?>" value="<?php echo $fecha; ?>">
                    <!--Imprimir el error si este existe-->
                    <?php if (!empty($fechaErr)) : ?><div class="invalid-feedback"><?php echo $fechaErr; ?></div><?php endif; ?>
                </div>

                <!--Campo para la imagen del proyecto-->
                <div class="form-group mb-4">
                    <label class="form-label">Imagen del proyecto</label>

                    <!--Mostrar el nombre si existe-->
                    <?php if (!empty($imagen_actual)) : ?>
                        <div class="alert alert-secondary p-2 mb-2">
                            <i class="fa-solid fa-image me-2"></i>
                            Imagen actual: <strong><?php echo basename($imagen_actual); ?></strong>
                            <br>
                            <img src="<?php echo $imagen_actual; ?>" style="height: 50px; margin-top: 5px;">
                        </div>
                    <?php endif; ?>

                    <!--Botón de subida de la imagen-->
                    <input type="file" name="imagen" class="form-control <?php echo !empty($imgErr) ? 'is-invalid' : ''; ?>" accept="image/*">
                    <small class="text-muted">Sube una nueva imagen para sustituir la actual (Opcional).</small>
                    <?php if (!empty($imgErr)) : ?><div class="invalid-feedback"><?php echo $imgErr; ?></div><?php endif; ?>
                </div>

                <hr>
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fa-solid fa-save me-2"></i> Guardar Proyecto
                </button>
                <a href="index.php" class="btn btn-secondary btn-lg">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php include("templates/footer.php"); ?>