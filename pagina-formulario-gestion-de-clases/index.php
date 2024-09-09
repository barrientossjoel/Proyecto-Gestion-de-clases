<?php
include("assets/php/conexion.php");
include("assets/php/funciones.php");
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_NONE) {
  session_start(); // Iniciar la sesión si no está activa
}

$_SESSION["CODIGO_USUARIO"] = 1;
date_default_timezone_set('America/Buenos_Aires');
// $_SESSION['NUMBER_CHECKBOX'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Gustavo Pavón, Maximiliano Acuña, Pablo Torrez">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Clases</title>
  <!-- Librería WaterCSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
  <!-- Styles CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/modal.css">

  <script type="module" src="assets/js/app.js" defer></script>
  <script type="module" src="assets/js/main.js" defer></script>

  <link rel="icon" href="assets/img/icono.png">
</head>

<body>
  <header id="header">
    <nav id="nav-bar">
      <ul>
        <a href="#" target="_blank" class="nav-links">
          <li>Pagina principal</li>
        </a>
        <a href="#" target="_blank" class="nav-links">
          <li>Ayuda</li>
        </a>
        <a href="cerrar_sesion.php" onclick="return confirm('¿Desea Cerrar Sesión?')" target="_blank" class="nav-links">
          <li>Cerrar Sesión</li>
        </a>
      </ul>
    </nav>
  </header>

  <?php include("assets/templates/modal_alta.php"); ?>
  <?php include("assets/templates/modal_modificacion.php"); ?>
  <?php include("assets/templates/modal_baja.php"); ?>

  <?php 
  if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); 

    if ( $message['type'] == 'error') { ?>
      <script>
        const $modal = document.querySelector(".modal"); 
        const bad = document.querySelector(".bad");
        $modal.classList.add("modal--show");
        bad.style.display = "block";
      </script>
      <?php
    }
  }
  ?>

  <div class="bg-body-style"></div>

  <main>
    <div class="container">

      <section id="seccion-menu">
        <div class="descripcion-menu">
          <img class="img-perfil-user" src="https://github.com/pablotorrez15.png" alt="Foto de Perfil de Usuario Profesor" width="80" height="80">
          <div class="contenedor-bienvenida-msg">
            <?php bienvenida($conn); ?>
          </div>
        </div>
        <div class="seccion-menu__items">
          <button class="btns-menu btn-alta" id="id-btn-alta">Alta de clase</button>
          <button class="btns-menu btn-modificar" id="id-btn-modificar" disabled>Modificar una clase</button>
          <button class="btns-menu btn-baja" id="id-btn-baja" disabled>Baja de clase</button>
          <div class="imagen-menu">
            <img class="img-logo-menu" src="assets/img/logo.png" width="150" height="150" alt="Logo Sistema de Administración Universal S.A.U" title="Logo Sistema de Administración Universal S.A.U">
          </div>
        </div>
      </section>

      <section id="seccion-tabla">
        <div class="contenedor-buscador-filtros">
          <div class="search">
            <input id="searchInput" disabled class="input-search" type="text" placeholder="Buscar por materia, comisión, aula...">
          </div>
          <div class="filter">
            <select id="filterSelect" class="Filtrar">
              <option value="Filtrar">Filtrar</option>
              <option value="Por Materia">Por Materia</option>
              <option value="Por Hora">Por Hora</option>
              <option value="Por Fecha">Por Fecha</option>
            </select>
          </div>
        </div>
    

        <div class="contenedor-tabla_principal">
          <table class="table_principal-heads">
              <thead>
                <tr>
                  <th class="columna-checkbox"></th>
                  <th>Materia</th>
                  <th>Comisión</th>
                  <th>Aula</th>
                  <th>Hora</th>
                  <th>Fecha</th>
                  <th>Temas</th>
                  <th>Novedades</th>
                  <th>Archivos</th>
                </tr>
              </thead>
          </table>
          <?php buscarClases($conn); ?>
        </div>
      </section>
    </div>
  </main>
  
  <script src="assets/js/search.js" defer></script>
</body>

</html>
