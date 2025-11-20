<?php
//Arhivo de utilidades con funciones reutilizables

//Borrar el último proyecto del array de proyectos
function borrarUltimoProyecto($proyectos) {
    array_pop($proyectos);
    return $proyectos;
}

//Filtrar los proyectos por categoría
function filtrarProyectosPorCategoria($proyectos, $categoria_id) {
    $proyectos_filtrados = [];

    foreach ($proyectos as $proyecto) {
        if (in_array($categoria_id, $proyecto['categorias'])) {
            array_push($proyectos_filtrados, $proyecto);
        }
    }

    return $proyectos_filtrados;
}

//Ordenar los proyectos por nombre ascendente o descendentemente
function ordenarProyectosPorNombre(&$proyectos_mostrar, $orden) {
    if ($orden == 'asc') {
        usort($proyectos_mostrar, function($a, $b) {
            return strcmp($a['titulo'], $b['titulo']);
        });
    } elseif ($orden == 'desc') {
        usort($proyectos_mostrar, function($a, $b) {
        return strcmp($b['titulo'], $a['titulo']);
        });
    }
}

//Obtener el año actual
function obtenerAnio() {
    return date('Y');
}

//Obtener la imagen del proyecto o la imagen por defecto si no existe
function obtenerImagenProyecto($imagen) {
    $defaultImg = 'static/images/default.png';

    if (empty($imagen) || !file_exists($imagen)) {
        return $defaultImg;
    }
    return $imagen;
}

//Obtener el nombre de la categoría a partir de su id
function obtenerNombreCategoria($id_categoria, $categorias) {
    foreach ($categorias as $categoria) {
        if ($categoria['id'] == $id_categoria) {
            return $categoria['nombre'];
        }
    }
    return "Desconocida";
}

//Función para convertir las fechas de los proyectos de string a timestamp
function convertirFechas($proyectos) {
    foreach($proyectos as $clave => $proyecto) {
        $proyectos[$clave]['fecha'] = strtotime($proyecto['fecha']);
    }
    return $proyectos;
}

//Limpiar los datos de entrada
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Ordenamos los proyectos por fecha según elija el usuario
function ordenarProyectosPorFecha(&$proyectos_mostrar, $orden) {
    if ($orden == '1') {
        $orden = SORT_ASC;
    } elseif ($orden == '-1') {
        $orden = SORT_DESC;
    } else {
        return;
    }

    array_multisort(array_column($proyectos_mostrar, 'fecha'), $orden, $proyectos_mostrar);
}

//Comprobar que el usuario está logueado mediante la cookie
function loggedIn() {
    return isset($_COOKIE['user_email']);
}
?>