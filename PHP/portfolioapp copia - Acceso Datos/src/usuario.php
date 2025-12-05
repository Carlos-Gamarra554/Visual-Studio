<?php
include("utiles.php");
include("datos.php");

//Redirigir a inicio de sesión con error si no está logueado
if (!loggedIn()) {
    header("Location: login.php?error=acceso");
    exit();
}

//Ejercicio 3. c) Cookie del usuario para conservar su información y poder verla o actualizarla
$email_actual = $_COOKIE['user_email'];
$id_usuario = -1;
$datos_usuario = [];

//Ej3. Apartado 3. Recuperar los datos del usuario del json
foreach($usuarios as $key => $usuario) {
    if($usuario['email'] == $email_actual) {
        $id_usuario = $key;
        $datos_usuario = $usuario;
        break;
    }
}

//Si no se encuentra el usuario se cierra la sesión
if($id_usuario == -1) {
    header("Location: logout.php");
    exit();
}

//Variables del usuario. Recoge los datos del JSON para mostrarlos en el formulario.
$nombre = isset($_POST['nombre']) ? test_input($_POST['nombre']) : ($datos_usuario['nombre'] ?? "");
$dni = isset($_POST['dni']) ? strtoupper(test_input($_POST['dni'])) : ($datos_usuario['dni'] ?? "");
$email = isset($_POST['email']) ? test_input($_POST['email']) : ($datos_usuario['email'] ?? "");
$password = isset($_POST['password']) ? $_POST['password'] : ($datos_usuario['password'] ?? "");

//Variables de error
$nombreErr = "";
$dniErr = "";
$emailErr = "";
$passwordErr = "";
$mensaje = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($nombre)) {
        $nombreErr = "Introduzca su nombre, por favor.";
    } elseif(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+\s+[a-zA-ZáéíóúÁÉÍÓÚñÑ]+\s+[a-zA-ZáéíóúÁÉÍÓÚñÑ]+.*$/", $nombre)) {
        $nombreErr = "Introduzca un nombre válido.";
    }

    if(empty($dni)) {
        $dniErr = "Introduzca su DNI, por favor.";
    } elseif (!preg_match("/^[0-9]{8}[A-Z]$/", $dni)) {
        $dniErr = "Formato de DNI inválido.";
    }

    if(empty($email)) {
        $emailErr = "Introduzca su email, por favor.";
    } elseif(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/", $email)) {
        $emailErr = "El formato del email no es válido.";
    } elseif ($email != $email_actual) {
        foreach ($usuarios as $usuario) {
            if ($usuario['email'] == $email) {
                $emailErr = "Este email ya está en uso.";
                break;
            }
        }
    }

    if (empty($password)) {
        $passwordErr = "Por favor, introduzca su contraseña.";
    }

    //Si no hay errores, se guarda la información
    if ($nombreErr === "" && $dniErr === "" && $emailErr === "" && $passwordErr === ""){
        $usuarios[$id_usuario]['nombre'] = $nombre;
        $usuarios[$id_usuario]['dni'] = $dni;
        $usuarios[$id_usuario]['email'] = $email;
        $usuarios[$id_usuario]['password'] = $password;

        file_put_contents('mysql/usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        if ($email != $email_actual) {
            setcookie("user_email", $email, time() + 3600, "/");
            $email_actual = $email;
        }

        $mensaje = "Datos actualizados correctamente.";
    }
}
?>

<?php include("templates/header.php"); ?>

<!--Ejercicio 3. b) Formulario para el mantenimiento de los datos del usuario-->
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <h2 class="mb-4"><i class="fa-solid fa-id-card me-2"></i> Mi Perfil de Usuario</h2>

            <!--Mensaje de éxito al actualizar la información-->
            <?php if ($mensaje): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i> <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Editar Datos Personales</h5>
                </div>
                <div class="card-body p-4">
                    <form action="usuario.php" method="POST">
                        
                        <!-- NOMBRE Y APELLIDOS -->
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">Nombre y Apellidos *</label>
                            <input type="text" name="nombre" class="form-control <?php echo !empty($nombreErr) ? 'is-invalid' : ''; ?>" 
                                   value="<?php echo htmlspecialchars($nombre); ?>">
                            <small class="text-muted">Introduzca un nombre y dos apellidos.</small>
                            <?php if ($nombreErr): ?><div class="invalid-feedback"><?php echo $nombreErr; ?></div><?php endif; ?>
                        </div>

                        <div class="row">
                            <!-- DNI -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">DNI *</label>
                                <input type="text" name="dni" class="form-control <?php echo !empty($dniErr) ? 'is-invalid' : ''; ?>" 
                                       value="<?php echo htmlspecialchars($dni); ?>" placeholder="12345678Z">
                                <?php if ($dniErr): ?><div class="invalid-feedback"><?php echo $dniErr; ?></div><?php endif; ?>
                            </div>

                            <!-- EMAIL -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email (Login) *</label>
                                <input type="email" name="email" class="form-control <?php echo !empty($emailErr) ? 'is-invalid' : ''; ?>" 
                                       value="<?php echo htmlspecialchars($email); ?>">
                                <?php if ($emailErr): ?><div class="invalid-feedback"><?php echo $emailErr; ?></div><?php endif; ?>
                            </div>
                        </div>

                        <!-- PASSWORD -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold">Cambiar contraseña *</label>
                            <div class="input-group">
                                <input type="password" name="password" id="inputPass" class="form-control <?php echo !empty($passErr) ? 'is-invalid' : ''; ?>"
                                    placeholder="Nueva contraseña">
                                <?php if ($passErr): ?><div class="invalid-feedback"><?php echo $passErr; ?></div><?php endif; ?>
                            </div>
                        </div>

                        <hr>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fa-solid fa-save me-2"></i> Actualizar Mis Datos
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("templates/footer.php"); ?>