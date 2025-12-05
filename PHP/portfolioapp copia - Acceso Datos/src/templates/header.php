<!--Plantilla de la cabecera del portfolio-->
<?php include_once("categorias.php"); ?>
<?php include_once("utiles.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Portfolio de proyectos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    

    <!--Enlaces de los estilos del portfolio con Bootstrap, FontAwesome, etc-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/flatly/bootstrap.min.css" integrity="sha384-qF/QmIAj5ZaYFAeQcrQ6bfVMAh4zZlrGwTPY7T/M+iTTLJqJBJjwwnsE5Y0mV7QK" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body class="d-flex flex-column min-vh-100">

<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Portfolio <?php echo obtenerAnio(); ?></span>
    </a>
    <!--Enlaces de navegación para inicio, contacto, categorías y administración-->
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a href="index.php"
            class="nav-link
                <?php if($_SERVER['SCRIPT_NAME']=="/index.php") { echo "active"; } ?>
            "
            class="nav-link active"
        >INICIO
    </a>
    </li>
    <!--Menú dropdown con las categorías de los proyectos-->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            CATEGORÍAS
            </a>
            <!--Recorremos el array de las categorías y extraemos sus nombres-->
            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php foreach($categorias as $categoria): ?>
                    <a class="dropdown-item" href="index.php?categoria_id=<?php echo $categoria['id']; ?>">
                        <?php echo $categoria['nombre']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
            
        </li>
        <li class="nav-item">
            <a href="contacto.php"
            class="nav-link
                <?php if($_SERVER['SCRIPT_NAME']=="/contacto.php") { echo "active"; } ?>
                "
            class="nav-link active"
            >CONTACTO
            </a>
        </li>

        <li class="nav-item">
            <a href="sobre_mi.php"
            class="nav-link
                <?php if($_SERVER['SCRIPT_NAME']=="/sobre_mi.php") { echo "active"; } ?>
                "
            class="nav-link active"
            >SOBRE MÍ
            </a>
        </li>

    <!--Actividad 1. c) Mostramos administración solo si está logueado, si no, redirigimos a login.php-->
    <!--Actividad 1. e) Si existe la cookie se muestra el LOG OUT-->
    <?php if(loggedIn()): ?>

        <!--Actividad 3. a) Menú desplegable en administración para la gestión de los usuarios-->
        <li class="nav-item dropdown mr-5">
                <a class="nav-link dropdown-toggle <?php echo (basename($_SERVER['PHP_SELF']) == 'contacto_lista.php' || basename($_SERVER['PHP_SELF']) == 'usuarios_lista.php' || basename($_SERVER['PHP_SELF']) == 'usuario.php') ? 'active' : ''; ?>" 
                   href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                   <i class="fa-solid fa-lock me-1"></i> ADMINISTRACIÓN
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="contacto_lista.php">
                        <i class="fa-solid fa-address-book me-2"></i> Lista de Contactos
                    </a>
                    <!-- NUEVA OPCIÓN USUARIO -->
                    <a class="dropdown-item" href="usuario.php">
                        <i class="fa-solid fa-user-gear me-2"></i> Mi Perfil (Usuario)
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="logout.php">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar Sesión
                    </a>
                </div>
            </li>

    <?php else: ?>
            <!--Botón para iniciar sesión-->
            <li class="nav-item ms-2 mr-5">
                <a class="nav-link btn btn-outline-primary fw-bold px-3" href="login.php">
                    <i class="fa-solid fa-right-to-bracket me-1"></i> INICIAR SESIÓN
                </a>
            </li>

    <?php endif; ?>
    </ul>
</header>