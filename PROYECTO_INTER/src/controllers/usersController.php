<?php
require_once "models/userModel.php";
require_once "assets/php/funciones.php";

class UsersController { 
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function crear(array $arrayUser): void
    {
        $error = false;
        $errores = [];
    //vaciamos los posibles errores
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        // ERRORES DE TIPO
        if (!is_valid_email($arrayUser["email"])) {
            $error = true;
            $errores["email"][] = "El email tiene un formato incorrecto";
        }
        
        //campos NO VACIOS
        $arrayNoNulos = ["email", "password", "nombre"];
        $nulos = HayNulos($arrayNoNulos, $arrayUser);
        if (count($nulos) > 0) {
            $error = true;
            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        //CAMPOS UNICOS
        $arrayUnicos = ["email", "id"];

        foreach ($arrayUnicos as $CampoUnico) {
            if ($this->model->exists($CampoUnico, $arrayUser[$CampoUnico])) {
                $errores[$CampoUnico][] = "El {$arrayUser[$CampoUnico]} de {$CampoUnico} ya existe";
                $error = true;
            }
        }

        $id = null;
        if (!$error) {
            $arrayUser["password"] = password_hash($arrayUser["password"], PASSWORD_DEFAULT);
            $id = $this->model->insert($arrayUser);
        }

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayUser;
            header("location:index.php?accion=crear&tabla=usuarios&error=true&id={$id}");
                exit ();
        } else {
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:index.php?accion=ver&tabla=usuarios&id=" . $id);
            exit ();
        }
    }

    public function ver(int $id): ?stdClass {
        return $this->model->read($id);
    }
    
    public function listar() {
        return $this->model->readAll ();
   }

   public function borrar(int $id): void {
    //Actividad 4. Obtener el nombre del usuario antes de borrarlo
    $usuarioAEliminar = $this->model->read($id);
    $nombre = $usuarioAEliminar ? $usuarioAEliminar->nombre : "Desconocido";

    $borrado = $this->model->delete($id);
    //Pasamos el nombre a la URL
    $redireccion = "location:index.php?accion=listar&tabla=usuarios&evento=borrar&id={$id}&nombre={$nombre}";
    
    if ($borrado == false) $redireccion .=  "&error=true";
    header($redireccion);
    exit();
}

    public function editar(string $idAntiguo, array $arrayUser): void
    {
        $error = false;
        $errores = [];

        // 1. Validación de Email
        if (!is_valid_email($arrayUser["email"])) {
            $error = true;
            $errores["email"][] = "El email tiene un formato incorrecto";
        }

        // 2. Verificar si el email ya existe en otro usuario
        if ($arrayUser["email"] !== $arrayUser["emailOriginal"]) {
            if ($this->model->exists("email", $arrayUser["email"])) {
                $error = true;
                $errores["email"][] = "Este email ya está en uso";
            }
        }

        if (!$error) {
            // 3. Cifrar contraseña solo si se ha modificado y no está vacía
            $arrayUser["password"] = password_hash($arrayUser["password"], PASSWORD_DEFAULT);
            
            $editado = $this->model->edit($idAntiguo, $arrayUser);
        }

        if ($error || !$editado) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayUser;
            header("location:index.php?tabla=usuarios&accion=editar&id={$idAntiguo}&error=true");
        } else {
            header("location:index.php?tabla=usuarios&accion=ver&id={$arrayUser['id']}&evento=modificar");
        }
        exit();
    }

    public function buscar(string $campo = "nombre", string $metodo = "contiene", string $texto = "", bool  $comprobarSiEsBorrable = false): array
{
    $users = $this->model->search($campo, $metodo, $texto);

    if ($comprobarSiEsBorrable) {
        foreach ($users as $user) {
            $user->esBorrable = $this->esBorrable($user);
        }
    }
    return $users;
}

private function esBorrable(stdClass $user): bool
{
    $projectController = new ProjectsController();
    $borrable = true;
    // si ese usuario está en algún proyecto, No se puede borrar.
    if (count($projectController->buscar("user_id", "igual", $user->id)) > 0)
        $borrable = false;

    return $borrable;
}

}