<?php
require_once('config/db.php');

class UserModel {
    private $conexion;

    public function __construct() {
        $this->conexion = db::conexion();
    }

    public function insert(array $user): ?int //devuelve entero o null
    {
        //Usar el try catch para capturar errores
        try {
            $sql = "INSERT INTO usuarios(nombre, email, password, rol)  VALUES (:nombre, :email, :password, :rol);";
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":nombre" => $user["nombre"],
                ":email" => $user["email"],
                ":password" => $user["password"],
                ":rol" => $user["rol"],
            ];
            $resultado = $sentencia->execute($arrayDatos);

            /*Pasar en el mismo orden de los ? execute devuelve un booleano. 
            True en caso de que todo vaya bien, falso en caso contrario.*/
            //Así podriamos evaluar
            return ($resultado == true) ? $this->conexion->lastInsertId() : null;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return null;
        }
    }

    public function read(int $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM usuarios WHERE id=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devuelve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $user = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($user == false) ? null : $user;
    }

    public function readAll():array 
{
    //Actividad 7. Cambiar la sentencia preparada a prepare en vez de query
    $sentencia = $this->conexion->prepare("SELECT * FROM usuarios;");
    $sentencia->execute();

    //Actividad 7. Cambiar el fetch para que devuelva un objeto
    $usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);    
    return $usuarios;
 }

public function delete (int $id):bool
{
    $sql="DELETE FROM usuarios WHERE id =:id";
    try {
        $sentencia = $this->conexion->prepare($sql);
        //devuelve true si se borra correctamente
        //false si falla el borrado
        $resultado= $sentencia->execute([":id" => $id]);
        return ($sentencia->rowCount ()<=0)?false:true;
    }  catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
        return false;
    }
}

public function edit (int $idAntiguo, array $arrayUsuario):bool{
    try {
            $sql="UPDATE usuarios SET nombre = :nombre, email = :email, ";
            $sql.= "password = :password, rol = :rol ";
            $sql.= " WHERE id = :id;";
            $arrayDatos=[
                    ":id"=>$idAntiguo,
                    ":nombre"=>$arrayUsuario["nombre"],
                    ":password"=>$arrayUsuario["password"],
                    ":rol"=>$arrayUsuario["rol"],
                    ":email"=>$arrayUsuario["email"],
                    ];
            $sentencia = $this->conexion->prepare($sql);
            return $sentencia->execute($arrayDatos); 
    } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
            }
}

public function search (string $campo, string $metodo, string $dato): array {
    $sql = "SELECT * FROM usuarios WHERE ";
    $camposPermitidos=["id", "nombre", "email"];

    if (!in_array($campo, $camposPermitidos)) {
        $campo="nombre";
    }

    $parametro = $dato;
        
    switch ($metodo) {
        case "empieza":
            $sql .= "$campo LIKE :dato";
            $parametro = "$dato%";
            break;
        case "acaba":
            $sql .= "$campo LIKE :dato";
            $parametro = "%$dato";
            break;
        case "contiene":
            $sql .= "$campo LIKE :dato";
            $parametro = "%$dato%";
            break;
        case "igual":
            $sql .= "$campo = :dato";
            $parametro = $dato;
            break;
        default:
            $sql .= "$campo LIKE :dato";
            $parametro = "%$dato%";
            break;
    }

    $sentencia = $this->conexion->prepare($sql);
    $arrayDatos = [":dato" => $parametro];
    $resultado = $sentencia->execute($arrayDatos);

    if (!$resultado) return [];
    //Actividad 7. Cambiamos a FETCH_OBJ
    $users = $sentencia->fetchAll(PDO::FETCH_OBJ);
    return $users;
    }

public function login(string $usuario, string $password): ?stdClass {
        // 1. Buscamos al usuario por su nombre de usuario
        $sentencia = $this->conexion->prepare("SELECT * FROM usuarios WHERE nombre=:nombre");
        $sentencia->execute([":nombre" => $usuario]);
        $user = $sentencia->fetch(PDO::FETCH_OBJ);

        // 2. Si el usuario existe, verificamos la contraseña cifrada
        if ($user && password_verify($password, $user->password)) {
            return $user; // Login correcto
        }

        return null; // Usuario no existe o contraseña incorrecta
    }

    public function exists(string $campo, string $valor):bool{
    $camposPermitidos = ["id", "nombre", "email"];
    if (!in_array($campo, $camposPermitidos)) {
        return false;
    }

   $sql = "SELECT COUNT(*) as total FROM usuarios WHERE $campo = :valor";
    $sentencia = $this->conexion->prepare($sql);
    $sentencia->execute([":valor" => $valor]);
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

    return ($resultado['total'] > 0);
   }

   public function getByEmail(string $email): ?stdClass {
    $sentencia = $this->conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
    $sentencia->execute([':email' => $email]);
    $user = $sentencia->fetch(PDO::FETCH_OBJ);
    return ($user == false) ? null : $user;
}
}
?>