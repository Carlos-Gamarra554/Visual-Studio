<?php
include("utiles.php");
include("datos.php");

$email = "";
$password = "";
$error_email = "";
$error_password = "";

//Comprobamos que se use el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Recogemos los datos del usuario
    $email = isset($_POST['email']) ? test_input($_POST['email']) : "";
    $password = isset($_POST['password']) ? test_input($_POST['password']) : "";

    //Actividad 1. b) Comprobamos que no haya ningún error en el email
    if (empty($email)) {
        $error_email = "Introduce un email para iniciar sesión.";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/", $email)) {
        $error_email = "El formato del email no es válido.";
    }

    //Comprobamos la contraseña
    if (empty($password)) {
        $error_password = "Introduce una contraseña para iniciar sesión.";
    }

    //Si no hay ningún error, buscamos al usuario en el json
    if(empty($error_email) && empty($error_password)) {
        $usuario_encontrado = false;
        $contr_correcta = false;

        foreach ($usuarios as $usuario) {
            if($usuario['email'] === $email){
                $usuario_encontrado = true;

                if ($usuario['password'] === $password) {
                    $contr_correcta = true;
                }
                break;
            }
        }

        //Actividad 1. c) Si se encuentra al usuario, se redirige a administración
        if (!$usuario_encontrado) {
            $error_email = "El usuario no existe en la base de datos.";
        } elseif (!$contr_correcta) {
            $error_password = "La contraseña es incorrecta.";
        } else {
            //Actividad 1. e) Almacena el email del usuario en una cookie con la variable user_email
            setcookie("user_email", $email, time() + 3600, "/");
            header("Location: contacto_lista.php");
            exit();
        }
    }
}

include("templates/header.php");
?>

<!--Mensaje de error para cuando no se tiene acceso a una página-->
<div class="container mt-1 mb-1">
    <?php if(isset($_GET['error']) && $_GET['error'] == 'acceso'): ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <i class="fa-solid fa-lock me-2"></i> 
            <strong>Acceso denegado.</strong> Necesitas iniciar sesión para acceder a esa página.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Iniciar Sesión</h4>
                </div>
                <div class="card-body">
                    <form action="login.php" method="POST">
                        
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control <?php echo !empty($error_email) ? 'is-invalid' : ''; ?>" 
                                   value="<?php echo htmlspecialchars($email); ?>" 
                                   placeholder="Introduce tu email">
                            <!--Actividad 1. d) Mensaje de error para el email incorrecto-->
                            <?php if (!empty($error_email)): ?>
                                <div class="text-danger small mt-1">
                                    <?php echo $error_email; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password">Contraseña:</label>
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="form-control <?php echo !empty($error_password) ? 'is-invalid' : ''; ?>" 
                                   value="<?php echo htmlspecialchars($password); ?>"
                                   placeholder="Introduce tu contraseña">
                            <!--Actividad 1. d) Mensaje de error para la contraseña incorrecta-->
                             <?php if (!empty($error_password)): ?>
                                <div class="text-danger small mt-1">
                                    <?php echo $error_password; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("templates/footer.php"); ?>