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
        // 1. Recogemos EMAIL
        $email = $_POST['email'] ?? ''; 
        $password = $_POST['password'] ?? '';

        // 2. Usamos getByEmail que ya está en el modelo
        $user = $this->model->getByEmail($email);

        // 3. Verificamos contraseña
        if ($user && password_verify($password, $user->password)) {
            // --- LOGIN CORRECTO ---
            $_SESSION['usuario_id'] = $user->id;
            $_SESSION['usuario_nombre'] = $user->nombre;
            $_SESSION['usuario_rol'] = $user->rol;
            
            header("Location: index.php");
            exit();
        } else {
            // --- LOGIN FALLIDO ---
            $_SESSION['error_login'] = "Credenciales incorrectas";
            header("Location: index.php?tabla=auth&accion=login&error=true");
            exit();
        }
    }

    public function doLogout() {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>