<?php
include("utiles.php");

    //Redirigimos al usuario al log in si no está logueado
    if (!loggedIn()) {
        header("Location: login.php?error=acceso");
        exit();
    }

    include("templates/header.php");

    $contactosLista = json_decode(file_get_contents('mysql/contactos.json'), true);
?>

<div class="container mb-5">
    <h1>Lista de contactos</h1>
    <?php if ($contactosLista === NULL) { ?>
        <div class="alert alert-info mt-5">
            Aún no ha sido contactado
        </div>    
    <?php } else { ?>
        <div class="list-group">
            <!--Redirección a la página de detalles del contacto por ID-->
            <?php foreach ($contactosLista as $contacto): ?>
                <a href="contacto_detalle.php?id=<?php echo $contacto['id'] ?>" class="list-group-item list-group-item-action"><?php echo $contacto['name'] ?> - <?php echo $contacto['email'] ?> - <?php echo $contacto['phone'] ?></a>
            <?php endforeach; ?>
        </div>
    <?php } ?>

</div>

<?php include("templates/footer.php"); ?>