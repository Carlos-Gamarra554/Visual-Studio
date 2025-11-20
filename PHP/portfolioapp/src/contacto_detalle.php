<!--Página de detalles del contacto-->
<?php include("templates/header.php"); ?>

<?php
$contacto_id = isset($_GET['id']) ? $_GET['id'] : null;
//El segundo parámetro es para que devuelva un array
$tempArray = json_decode(file_get_contents('mysql/contactos.json'), true);
//Presuponemos que contactos.json no está vacío, pero la URL se puede manipular manualmente

$contacto = null;

if ($tempArray && $contacto_id !== NULL){
    foreach ($tempArray as $item) {
        if (isset($item['id']) && $item['id'] == $contacto_id) {
            $contacto = $item;
            break;
        }
    }
}
?>

<div class="container">
    <h1 class="mb-5">Detalle del contacto</h1>
    <!--Extraemos y mostramos la información del contacto si no está vacío-->
    <?php if(!empty($contacto)) { ?>
        <p><?php echo $contacto['name'] ?></p>
        <p><?php echo $contacto['phone'] ?></p>
        <p><?php echo $contacto['tipo'] ?></p>
        <p><?php echo $contacto['email'] ?></p>
        <p><?php echo $contacto['mensaje'] ?></p>
        <?php if($contacto['file']) { ?>
            <a href="<?php echo $contacto['file'] ?>" class="btn btn-info mb-4"><i class="fa-solid fa-paperclip"></i> ARCHIVO ADJUNTO</a> <br>
        <?php } ?>
    <?php } else { ?>
        <div class="alert alert-danger mt-5">
            En contacto no existe.
        </div>    
    <?php } ?>
    <a href="contacto_lista.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left mr-2"></i> Volver</a>
</div>

<?php include("templates/footer.php"); ?>