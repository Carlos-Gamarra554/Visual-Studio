<?php
$proyecto_select_all = "SELECT * FROM proyecto";

function get_proyecto_detail($conn, $proyecto_id){
    $proyecto_select_detail = "SELECT * FROM proyecto WHERE id = :proy_id";
    $consulta = $conn->prepare($proyecto_select_detail);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->bindParam(":proy_id", $proyecto_id);
    $isOk = $consulta->execute();

    if ($consulta -> rowCount() == 0){
        trigger_error("No se ha encontrado el ID de proyecto");
    }    
    if ($consulta -> rowCount() > 1){
        trigger_error("Se ha recuperado más de un registro");
    }
    return $consulta->fetch();    
}
?>