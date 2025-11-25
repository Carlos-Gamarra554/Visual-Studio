<!--Página de contacto del portfolio-->
<?php include ("datos.php"); ?>
<?php include ("templates/header.php"); ?>

<div class="container mb-5">
    <h2 class="mb-5">Sobre Mí</h2>
    <div class="row">
        <div class="col-md">
            <img src="static/images/businessman.webp" class="img-fluid rounded">
        </div>
        <div class="col-md">
            <h3><?php echo $miNombre; ?></h3>
            <p>Ciclo Superior DAW.</p>
            <p>Apasionado del mundo de la programación en general, y de las tecnologías web en particular.</p>
            <p>Si tienes cualquier tipo de pregunta, contacta conmigo por favor.</p>
            <p>Teléfono: 87654321</p>
        </div>
    </div>
</div>

<?php include("templates/footer.php"); ?>