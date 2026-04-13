<?php
//Actividad 8. Crear el controlador ClientsController.php
require_once "models/clientModel.php";

class ClientsController { 
    private $model;

    public function __construct() {
        $this->model = new ClientModel();
    }

    public function crear(array $arrayCliente): void {
        $id = $this->model->insert($arrayCliente);
        
        if ($id == null) {
            header("location:index.php?tabla=client&accion=crear&error=true");
        } else {
            header("location:index.php?tabla=client&accion=ver&id=".$id);
        }
        exit();
    }

    public function ver(int $id): ?stdClass {
        return $this->model->read($id);
    }
    
    public function listar() {
        return $this->model->readAll();
    }

    public function borrar(int $id): void {
        $cliente = $this->model->read($id);
        $nombre = $cliente ? $cliente->contact_name : "Desconocido";

        $borrado = $this->model->delete($id);
        
        $redireccion = "location:index.php?accion=listar&tabla=client&evento=borrar&id={$id}&nombre={$nombre}";
        
        if ($borrado == false) $redireccion .= "&error=true";
        header($redireccion);
        exit();
    }

    public function editar(int $id, array $arrayCliente): void {
        $editado = $this->model->edit($id, $arrayCliente);
        
        $redireccion = "location:index.php?tabla=client&accion=editar&evento=modificar&id={$id}";
        $redireccion .= "&nombre=" . urlencode($arrayCliente['contact_name']);
        
        if ($editado == false) $redireccion .= "&error=true";
        header($redireccion);
        exit();
    }

    public function buscar(string $campo, string $metodo, string $dato): array {
        return $this->model->search($campo, $metodo, $dato);
    }
}
?>