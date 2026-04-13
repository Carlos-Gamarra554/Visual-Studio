<?php
require_once "models/userModel.php";

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function doLogin() {
        // 1. Recoger datos del formulario
        // Usamos 'usuario' porque así lo llamaste en tu vista login.php (<input name="usuario">)
        $usuario = $_POST['usuario'] ?? ''; 
        $password = $_POST['password'] ?? '';

        // 2. Llamar al modelo (que ya sabemos que funciona)
        $user = $this->model->login($usuario, $password);

        if ($user) {
            // --- LOGIN CORRECTO ---
            
            // Guardamos los datos importantes en la sesión
            $_SESSION['usuario_id'] = $user->id;
            $_SESSION['usuario'] = $user->usuario;
            $_SESSION['nombre'] = $user->name;
            // Si tuvieras roles, sería: $_SESSION['rol'] = $user->rol;
            
            // Redirigimos al Dashboard (index.php)
            header("Location: index.php");
            exit(); // Importante para detener el script aquí
        } else {
            // --- LOGIN FALLIDO ---
            
            // Redirigimos al login con aviso de error
            header("Location: index.php?tabla=auth&accion=login&error=true");
            exit();
        }
    }

    public function doLogout() {
        // Borramos la sesión
        session_destroy();
        // Redirigimos al login
        header("Location: index.php?tabla=auth&accion=login&session=logout");
        exit();
    }
}
?>