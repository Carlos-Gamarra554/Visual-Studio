<?php
require_once "controllers/usersController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$controlador = new UsersController();

$busqueda = "";
$campoSeleccionado = "usuario";
$metodoSeleccionado = "contiene";

if (isset($_REQUEST["evento"])) {
    $mostrarDatos = true;
    switch ($_REQUEST["evento"]) {
        case "todos":
            $users = $controlador->listar();
            $mostrarDatos = true;
            break;
        case "filtrar":
            $busqueda = ($_REQUEST["busqueda"]) ?? "";
            $campoSeleccionado = ($_REQUEST["campo"]) ?? "usuario";
            $metodoSeleccionado = ($_REQUEST["metodo"]) ?? "contiene";

            $users = $controlador->buscar($campoSeleccionado, $metodoSeleccionado, $busqueda);
            break;
        case "borrar":
            $visibilidad = "visibility";
            $mostrarDatos = true;
            $clase = "alert alert-success";
            //Mejorar y poner el nombre/usuario
            $mensaje = "El usuario con id: {$_REQUEST['id']} Borrado correctamente";
            if (isset($_REQUEST["error"])) {
                $clase = "alert alert-danger ";
                $mensaje = "ERROR!!! No se ha podido borrar el usuario con id: {$_REQUEST['id']}";
            }
            break;
    }
} ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Buscar Usuario Avanzado</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?= $mensaje ?>
        </div>
        
        <div class="mb-4">
            <form action="index.php?tabla=user&accion=buscar&evento=filtrar" method="POST">
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label for="campo">Buscar en:</label>
                        <select class="form-control form-select" name="campo" id="campo">
                            <option value="id" <?= $campoSeleccionado == 'id' ? 'selected' : '' ?>>ID</option>
                            <option value="usuario" <?= $campoSeleccionado == 'usuario' ? 'selected' : '' ?>>Usuario</option>
                            <option value="name" <?= $campoSeleccionado == 'name' ? 'selected' : '' ?>>Nombre</option>
                            <option value="email" <?= $campoSeleccionado == 'email' ? 'selected' : '' ?>>Email</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="metodo">Tipo de coincidencia:</label>
                        <select class="form-control form-select" name="metodo" id="metodo">
                            <option value="empieza" <?= $metodoSeleccionado == 'empieza' ? 'selected' : '' ?>>Empieza por</option>
                            <option value="acaba" <?= $metodoSeleccionado == 'acaba' ? 'selected' : '' ?>>Acaba en</option>
                            <option value="contiene" <?= $metodoSeleccionado == 'contiene' ? 'selected' : '' ?>>Contiene</option>
                            <option value="igual" <?= $metodoSeleccionado == 'igual' ? 'selected' : '' ?>>Igual a</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="busqueda">Dato a buscar:</label>
                        <input type="text" required class="form-control" id="busqueda" name="busqueda" value="<?= $busqueda ?>" placeholder="Escribe aquí...">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100" name="Filtrar"><i class="fas fa-search"></i> Buscar</button>
                    </div>
                </div>
            </form>

            <form action="index.php?tabla=user&accion=buscar&evento=todos" method="POST" class="mt-2">
                <button type="submit" class="btn btn-info" name="Todos"><i class="fas fa-list"></i> Ver Todos</button>
            </form>
        </div>

        <?php
        if ($mostrarDatos) {
        ?>
            <table class="table table-light table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Verificación extra por si la búsqueda no devuelve nada
                    if (empty($users)) {
                        echo '<tr><td colspan="6" class="text-center">No se encontraron resultados</td></tr>';
                    } else {
                        foreach ($users as $user) :
                            $id = $user["id"];
                        ?>
                            <tr>
                                <th scope="row"><?= $user["id"] ?></th>
                                <td><?= $user["usuario"] ?></td>
                                <td><?= $user["name"] ?></td>
                                <td><?= $user["email"] ?></td>
                                <td><a class="btn btn-danger" href="index.php?tabla=user&accion=borrar&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
                                <td><a class="btn btn-success" href="index.php?tabla=user&accion=editar&id=<?= $id ?>"><i class="fas fa-pencil-alt"></i> Editar</a></td>
                            </tr>
                        <?php
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>
    </div>
</main>