<?php
session_start();
ob_start();
require_once("router/router.php");

// Si la tabla es 'auth', asumimos que es una página de login/logout que no requiere menú
$esPaginaLogin = (isset($_REQUEST['tabla']) && $_REQUEST['tabla'] == 'auth');

require_once("views/layout/head.php");

if ($esPaginaLogin) {
    $vista = router();
    require_once($vista);
    
} else {
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php
            require_once "views/layout/navbar.php";
            ?>

            <?php
            $vista = router();
            require_once($vista);
            ?>
        </div>
    </div>
    <?php
    }

require_once("views/layout/footer.php");
ob_end_flush();
?>
