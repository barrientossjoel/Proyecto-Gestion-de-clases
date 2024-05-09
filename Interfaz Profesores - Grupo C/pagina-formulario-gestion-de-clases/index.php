<?php
include("assets/php/conexion.php");
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_NONE) {
  session_start(); // Iniciar la sesión si no está activa
}

$_SESSION["CODIGO_USUARIO"] = 1;
// $_SESSION['NUMBER_CHECKBOX'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Clases</title>
  <!-- Librería WaterCSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
  <!-- Styles CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/modal.css">
  <link rel="icon" href="assets/img/icono.jpg">


  <script type="module" src="assets/js/app.js" defer></script>
  <script type="module" src="assets/js/main.js" defer></script>
</head>

<body>
  <header>
    <p class="name-page">Gestión de Clases</p>
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

  <main>
    <div class="contenedor-bienvenida-msg">
      <p>¡Bienvenido
        <?php
        $query_welcome = "SELECT NOMBRE_PERSONA, APELLIDO_PERSONA, CARGO FROM PERSONAS WHERE CARGO = 'Profesor'";
        $res_welcome = mysqli_query($conn, $query_welcome);
        if ($res_welcome) {
          $fila_welcome = mysqli_fetch_assoc($res_welcome);
        ?>
          <?php echo $fila_welcome['NOMBRE_PERSONA'] . " " . $fila_welcome['APELLIDO_PERSONA']; ?>! <span style="font-weight: bold; color:darkorange;">(<?php echo $fila_welcome['CARGO']; ?>)</span></p>
    <?php
        } else {
          echo "Hubo un error al hacer la consulta de Bienvenida: " . mysqli_error($conn);
        }
    ?>

    <?php
    if (isset($_GET['clase_agregada']) && $_GET['clase_agregada'] == 'true') {
    ?>
      <div class="msg-alta-success">
        La clase se agregó correctamente
      </div>
    <?php
    }
    ?>
    </div>


    <div class="container">

      <section id="menu">
        <div class="descripcion-menu">
          <h3 class="heading3-descripcion">¿Qué quieres hacer?</h3>
        </div>
        <div class="btn-menu">
          <button class="btn-alta btns-menu" id="id-btn-alta">Alta de clase</button>
          <button class="btn-modificar btns-menu" id="id-btn-modificar" disabled>Modificar una clase</button>
          <button class="btn-baja btns-menu" id="id-btn-baja" disabled>Baja de clase</button>
          <div class="imagen-menu">
            <img class="img-logo-menu" src="assets/img/logo.jpg" width="150" height="150" alt="Logo Sistema de Administración Universal S.A.U" title="Logo Sistema de Administración Universal S.A.U">
          </div>
        </div>
      </section>

      <section id="tabla-clases">
        <div class="contenedor-buscador-filtros">
          <div class="search">
            <input class="input-search" type="text" placeholder="Buscar">
            <input class="input-submit-search" type="submit" value="🔎">
          </div>
          <div class="filter">
            <select>
              <option value="">Filtrar</option>
              <option value="Por fecha">Por fecha</option>
              <option value="Por hora">Por hora</option>
              <option value="Por Materia">Por Materia</option>
            </select>
          </div>
        </div>
        <div class="contenedor-tabla">
          <table>

            <thead>
              <tr>
                <th class="th-class-checkbox"></th>
                <th class="th-class-materia">Materia</th>
                <th class="th-class-comision">Comisión</th>
                <th class="th-class-aula">Aula</th>
                <th class="th-class-hora">Hora</th>
                <th class="th-class-fecha">Fecha</th>
                <th class="th-class-temas">Temas</th>
                <th class="th-class-novedades">Novedades</th>
                <th class="th-class-archivos">Archivos</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $consulta = "SELECT clases.ID_CLASE, clases.CODIGO_USUARIO, usuxrol.CODIGO_ROL,
              materias.ID_MATERIA, materias.NOMBRE_MATERIA,
              clases.COMISION, clases.AULA, clases.FECHA, clases.HORA, clases.TEMAS, clases.NOVEDADES,
              clases.ARCHIVOS
              FROM clases, usuarios, materias, usuxrol
              WHERE clases.CODIGO_USUARIO = usuarios.CODIGO_USUARIO
              AND clases.ID_MATERIA = materias.ID_MATERIA
              AND usuxrol.CODIGO_USUARIO = clases.CODIGO_USUARIO";
              $resultado = mysqli_query($conn, $consulta);
              mostrarDatos($resultado);
              ?>
            </tbody>

          </table>
        </div>
      </section>
    </div>
  </main>

  <footer></footer>
</body>

</html>

<?php
function mostrarDatos($result)
{
  if (isset($result) && $result->num_rows > 0) {
    $id_clase_chkbx = null;
    while ($fila = mysqli_fetch_array($result)) {
      $id_clase_chkbx = $fila['ID_CLASE'];
      $_SESSION['NUMBER_CHECKBOX'] = $id_clase_chkbx;
?>
      <tr>
        <td><input class="input-checkbox-register" id="chkbx-<?php echo $id_clase_chkbx; ?>" type="checkbox" name="seleccionar_registro" value="<?php echo $id_clase_chkbx; ?>"></td>
        <!-- <td><php echo $fila['TITULO_ABREVIADO']; ?></td> -->
        <td><?php echo $fila['NOMBRE_MATERIA']; ?></td>
        <td><?php echo $fila['COMISION']; ?></td>
        <td><?php echo $fila['AULA']; ?></td>
        <td><?php echo $fila['HORA']; ?></td>
        <td><?php echo $fila['FECHA']; ?></td>
        <td><textarea class="td_textarea" rows="1" readonly><?php echo $fila['TEMAS']; ?></textarea></td>
        <td><textarea class="td_textarea" rows="1" readonly><?php echo $fila['NOVEDADES']; ?></textarea></td>
        <td><?php echo $fila['ARCHIVOS']; ?></td>
      </tr>
      <?php
      ?>
      <!-- Script para manejar el evento del checkbox. Para visualizar problemas futuros. -->
      <script>
        let checkbox<?php echo $id_clase_chkbx; ?> = document.getElementById("chkbx-<?php echo $id_clase_chkbx; ?>")
        if (checkbox<?php echo $id_clase_chkbx; ?>) {
          checkbox<?php echo $id_clase_chkbx; ?>.addEventListener("click", () => console.log(checkbox<?php echo $id_clase_chkbx; ?>));
        } else {
          console.warn("Checkbox no encontrado para ID <?php echo $id_clase_chkbx; ?>")
        }
      </script>
<?php
    }
  } else {
    echo "<tr><td colspan='8' style='font-size:20px;'>No se encontró ninguna clase registrada...</td></tr>";
  }
}

?>
