<?php
  $msg = ""; 
  $visibilidad = "invisible"; 
  $style = "";
  
  if (isset($_GET["error"]) && $_GET["error"] == "true"){
    $msg = "Error, Usuario o Password Incorrectos";
    $visibilidad = "visible";
    $style = "alert-danger";
  }
  if (isset($_GET["session"]) && $_GET["session"] == "logout"){
    $msg = "Fin de Sesion";
    $visibilidad = "visible";
    $style = "alert-success";
  }
  
  $userValue = "";
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/sign-in.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
<main class="form-signin w-100 m-auto text-center" style="max-width: 330px;">
  <form action="index.php?tabla=auth&accion=validar" method="POST">
    <h1 class="h3 mb-3 fw-normal">Inicio de Sesión</h1>

    <div class="alert <?=$style?> <?=$visibilidad?>"><?=$msg?></div>

    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
      <label for="usuario">Usuario / Email</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      <label for="password">Contraseña</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
  </form>
</main>
</body>
</html>