<?php
class db {
    public static function conexion() {
        $servidor = "mysql";
        $usuario = "admin";
        $password = "admin";
        $base_datos = "lunazuldb";
        
        try {
            $conexion = new PDO("mysql:host=$servidor;dbname=$base_datos;charset=utf8", $usuario, $password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            die("Fallo en la conexión: " . $e->getMessage());
        }
    }
}
?>