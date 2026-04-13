<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>APP MVC Y PDO</title>
  
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  
  <link href="assets/css/dashboard.css" rel="stylesheet">
  <link href="assets/css/404.css" rel="stylesheet">
</head>
<body>

  <?php
  //Solo mostramos el header si no es página de login
  if (!isset($esPaginaLogin) || $esPaginaLogin == false): 
  ?>
  
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">Aplicacion MVC</a>
    
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="navbar-nav flex-row">
      <?php 
      // Verificamos si hay sesión iniciada
      if (isset($_SESSION['usuario_id'])): 
      ?>
          <div class="nav-item text-nowrap">
            <span class="nav-link px-3 disabled text-white">
                <i class="fas fa-user"></i> 
                <?= $_SESSION['nombre'] ?? 'Usuario' ?>
            </span>
          </div>

          <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="index.php?tabla=auth&accion=logout">
                <i class="fas fa-sign-out-alt"></i> Salir
            </a>
          </div>

      <?php else: ?>
          
          <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="index.php?tabla=auth&accion=login">
                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
            </a>
          </div>

      <?php endif; ?>
    </div>
  </header>
<?php 
  endif; 
  ?>