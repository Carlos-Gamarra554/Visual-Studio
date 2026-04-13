<?php
require_once "models/projectModel.php";

class ProjectsController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProjectModel();
    }

    public function buscar(string $campo = "id", string $metodo = "contiene", string $texto = "", $esBorrable = false): array
    {

        $projects = $this->model->search($campo, $metodo, $texto);
        return $projects;
    }
}