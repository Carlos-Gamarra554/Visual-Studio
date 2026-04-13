<?php
//Actividad 8. Crear el modelo ClientModel con las operaciones CRUD y de búsqueda
require_once('config/db.php');

class ClientModel {
    private $conexion;

    public function __construct() {
        $this->conexion = db::conexion();
    }

    public function readAll(): array {
        $sentencia = $this->conexion->prepare("SELECT * FROM clients;");
        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function read(int $id): ?stdClass {
        $sentencia = $this->conexion->prepare("SELECT * FROM clients WHERE id=:id");
        $sentencia->execute([":id" => $id]);
        $cliente = $sentencia->fetch(PDO::FETCH_OBJ);
        return ($cliente == false) ? null : $cliente;
    }

    public function insert(array $datos): ?int {
        try {
            $sql = "INSERT INTO clients (idFiscal, contact_name, contact_email, contact_phone_number, company_name, company_address, company_phone_number) 
                    VALUES (:idFiscal, :c_name, :c_email, :c_phone, :co_name, :co_address, :co_phone)";
            
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":idFiscal"   => $datos["idFiscal"],
                ":c_name"     => $datos["contact_name"],
                ":c_email"    => $datos["contact_email"],
                ":c_phone"    => $datos["contact_phone_number"],
                ":co_name"    => $datos["company_name"],
                ":co_address" => $datos["company_address"],
                ":co_phone"   => $datos["company_phone_number"]
            ];
            
            $resultado = $sentencia->execute($arrayDatos);
            return ($resultado == true) ? $this->conexion->lastInsertId() : null;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return null;
        }
    }

    public function edit(int $id, array $datos): bool {
        try {
            $sql = "UPDATE clients SET 
                    idFiscal = :idFiscal,
                    contact_name = :c_name, 
                    contact_email = :c_email, 
                    contact_phone_number = :c_phone,
                    company_name = :co_name,
                    company_address = :co_address,
                    company_phone_number = :co_phone
                    WHERE id = :id";
            
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":id" => $id,
                ":idFiscal" => $datos["idFiscal"],
                ":c_name" => $datos["contact_name"],
                ":c_email" => $datos["contact_email"],
                ":c_phone" => $datos["contact_phone_number"],
                ":co_name" => $datos["company_name"],
                ":co_address" => $datos["company_address"],
                ":co_phone" => $datos["company_phone_number"]
            ];
            return $sentencia->execute($arrayDatos);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }

    public function delete(int $id): bool {
        try {
            $sql = "DELETE FROM clients WHERE id = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->execute([":id" => $id]);
            return ($sentencia->rowCount() > 0);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }

    public function search(string $campo, string $metodo, string $dato): array {
        $sql = "SELECT * FROM clients WHERE ";
        
        $camposPermitidos = ["id", "contact_name", "company_name", "contact_email", "idFiscal"];
        if (!in_array($campo, $camposPermitidos)) {
            $campo = "contact_name";
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
        }

        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute([":dato" => $parametro]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
}
?>