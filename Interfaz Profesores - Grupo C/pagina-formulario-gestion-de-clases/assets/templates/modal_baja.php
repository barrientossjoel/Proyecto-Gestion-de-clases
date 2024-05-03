<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_NONE) {
  session_start(); // Iniciar la sesión si no está activa
}
?>

<section class="modal2">
  <div class="modal2__container">
    <div class="btn-cerrar-modal2"><a href="#" class="modal2__close" title="Cerrar">X</a></div>

    <h2 class="modal2__title">Baja de Clases</h2>
    <p>¿Esta seguro de querer eliminar estas clases?</p>

    <form method="POST">
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
          $id_materia = $materia = $comision = $hora = $fecha = $aula = $temas = $novedades = $archivos = "";

          if (isset($_SESSION['NUMBER_CHECKBOX'])) {
            $valores_checkbox = (array)$_SESSION['NUMBER_CHECKBOX'];
            $valor_checkbox = implode("", $valores_checkbox);
            $id_usuario = $_SESSION['CODIGO_USUARIO'];

            $consulta = "SELECT CLASES.ID_CLASE, CLASES.CODIGO_USUARIO, USUXROL.CODIGO_ROL, MATERIAS.ID_MATERIA, MATERIAS.NOMBRE_MATERIA, CLASES.COMISION, CLASES.AULA, CLASES.FECHA, CLASES.HORA, CLASES.TEMAS, CLASES.NOVEDADES, CLASES.ARCHIVOS FROM CLASES
              JOIN USUARIOS ON CLASES.CODIGO_USUARIO = USUARIOS.CODIGO_USUARIO
              JOIN MATERIAS ON CLASES.ID_MATERIA = MATERIAS.ID_MATERIA
              JOIN USUXROL ON USUXROL.CODIGO_USUARIO = CLASES.CODIGO_USUARIO
              WHERE CLASES.CODIGO_USUARIO = '$id_usuario'
              AND CLASES.ID_CLASE = '$valor_checkbox'";

            $resultado = mysqli_query($conn, $consulta);

            mostrarDatos($resultado);
          }
          ?>
        </tbody>
      </table>

      <input type="submit" name="btn_Baja" value="Eliminar" class="btn_añadir">
    </form>
  </div>
</section>


<?php
if (isset($_POST['btn_Baja'])) {
  if (isset($_SESSION['NUMBER_CHECKBOX'])) {
    $valores_checkbox = $_SESSION['NUMBER_CHECKBOX'];
    $id_usuario = $_SESSION['CODIGO_USUARIO'];

    if (is_array($valores_checkbox)) {
      $query = "DELETE FROM CLASES WHERE ID_CLASE = ? AND CODIGO_USUARIO = ?";
      $stmt = $conn->prepare($query);
      if ($stmt) {
        foreach ($valores_checkbox as $id_clase) {
          $stmt->bind_param("is", $id_clase, $id_usuario);
          $stmt->execute();
        }

        if ($stmt->affected_rows > 0) {
          echo "<tr><td colspan='6' style='font-size:20px';>Clases eliminadas correctamente.</td></tr>";
          unset($_SESSION['NUMBER_CHECKBOX']);
        } else {
          echo "<tr><td colspan='6' style='font-size:20px';>No se han podido eliminar las clases.</td></tr>";
        }
        $stmt->close();
      } else {
        echo "<tr><td colspan='6' style='font-size:20px';>Error en la preparación de la consulta de eliminación.</td></tr>";
      }
    }
  } else {
    echo "<tr><td colspan='6' style='font-size:20px';>No se han seleccionado clases para eliminar.</td></tr>";
  }
} else {
  //echo "<tr><td colspan='6' style='font-size:20px';>No se pudo eliminar las clases. Error con el Botón.</td></tr>";
}
?>
