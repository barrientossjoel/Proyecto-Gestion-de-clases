<?php
include("assets/php/conexion.php");
// session_start();
// $_SESSION["CODIGO_USUARIO"] = 1;

$id_materia = $materia = $comision = $hora = $fecha = $aula = $temas = $novedades = $archivos = "";

if (isset($_SESSION['NUMBER_CHECKBOX'])) {
  $valores_checkbox = (array)$_SESSION['NUMBER_CHECKBOX'];
  $valor_checkbox = implode("", $valores_checkbox);
  $id_usuario = $_SESSION["CODIGO_USUARIO"];

  $consulta = "SELECT CLASES.ID_CLASE, CLASES.CODIGO_USUARIO, USUXROL.CODIGO_ROL,
  MATERIAS.CODIGO_MATERIA, MATERIAS.NOMBRE_MATERIA,
  CLASES.COMISION, CLASES.AULA, CLASES.FECHA, CLASES.HORA, CLASES.TEMAS, CLASES.NOVEDADES,
  CLASES.ARCHIVOS
  FROM CLASES
  JOIN USUARIOS ON CLASES.CODIGO_USUARIO = USUARIOS.CODIGO_USUARIO
  JOIN MATERIAS ON CLASES.CODIGO_MATERIA = MATERIAS.CODIGO_MATERIA
  JOIN USUXROL ON USUXROL.CODIGO_USUARIO = CLASES.CODIGO_USUARIO
  WHERE CLASES.CODIGO_USUARIO = '$id_usuario'
  AND CLASES.ID_CLASE = '$valor_checkbox'";

  $resultado = mysqli_query($conn, $consulta);
  if ($resultado && $resultado->num_rows > 0) {
    $fila = mysqli_fetch_array($resultado);

    $id_materia = $fila['CODIGO_MATERIA'];
    $materia = $fila['NOMBRE_MATERIA'];
    $comision = $fila['COMISION'];
    $hora = $fila['HORA'];
    $fecha = $fila['FECHA'];
    $aula = $fila['AULA'];
    $temas = $fila['TEMAS'];
    $novedades = $fila['NOVEDADES'];
    $archivos = $fila['ARCHIVOS'];
  }
}
?>



<section class="modal3">
  <div class="modal3__container">
    <div class="btn-cerrar-modal3"><a href="#" class="modal3__close" title="Cerrar">X</a></div>

    <h2 class="modal__title3">Modificacion de Clase</h2>
    <h3 class="bad">Por favor complete los campos indicados de manera correcta.</h3>

    <form method="post">
      <label for="new-materia-id">
        Materia
        <select class="inputs-modal mod_materia" name="new_materia" id="new-materia-id">
          <option value="<?php echo $id_materia; ?>" class="op-materia"><?php echo $materia; ?></option>
          <?php
          obtenerMaterias($conn);
          ?>
        </select>
      </label>

      <label for="new-comision-id">
        Comisión
        <select class="inputs-modal mod_comision" name="new_comision" id="new-comision-id">
          <option value="<?php echo $comision; ?>" class="op-comision hidden" selected><?php echo $comision; ?></option>
          <option value="1ro1ra">1ro1ra</option>
          <option value="1ro2da">1ro2da</option>
          <option value="1ro3ra">1ro3ra</option>
          <option value="2do1ra">2do1ra</option>
          <option value="2do2da">2do2da</option>
          <option value="3ro1ra">3ro1ra</option>
          <option value="3ro2da">3ro2da</option>
        </select>
      </label>

      <label for="aula-id">
        Aula:
        <input type="number" min="1" max=100 placeholder="Ingrese número de aula" class="inputs-modal" name="aula" id="aula-id" value="<?php echo $aula; ?>">
      </label>

      <label for="new-hora-id">
        Hora
        <select class="inputs-modal mod_hora" name="new_hora" id="new-hora-id">
          <option value="<?php echo $hora; ?>" class="op-hora"><?php echo $hora; ?></option>
          <option value="8:00-10:00">8:00-10:00</option>
          <option value="10:10-12:00">10:10-12:00</option>
          <option value="8:00-12:00">8:00-12:00</option>
          <option value="18:00-22:00">18:00-22:00</option>
          <option value="20:10-22:00">20:10-22:00</option>
          <option value="18:00-20:00">18:00-20:00</option>
        </select>
      </label>

      <label for="new-fecha-id">
        Fecha
        <input class="inputs-modal mod_fecha" id="new-fecha-id" type="date" name="new_fecha" value="<?php echo $fecha; ?>">
      </label>

      <textarea name="new_temas" maxlength="50" rows="2" placeholder="Ingresá una tarea" class="textarea-form-class"><?php echo $temas; ?></textarea>

      <textarea name="new_novedad" maxlength="50" rows="2" placeholder="¿Alguna Novedad?" class="textarea-form-class"><?php echo $novedades; ?></textarea>

      <label for="archivo_actual" class="form-label">
        Archivo actual: <?php echo $archivos; ?>
      </label>
      <!-- <php if (!empty($archivos)) : ?>
        <div class="container">
          <a href="descargar_archivo.php?nombre=<php echo $archivos; ?>" target="_blank">Descargar archivo</a><br>
          <a href="eliminar_archivo.php?nombre=<php echo $archivos; ?>">Eliminar archivo</a><br>
        </div>
      <php endif; ?> -->
      <input type="file" class="form-control" name="new_archivo" id="archivo_actual" placeholder="" aria-describedby="fileHelpId" />

      <input type="submit" name="btn_Modificar" value="Actualizar" class="btn_añadir">

    </form>
    <h3 class="bad">¡Por favor complete los campos indicados de manera correcta! </h3>

  </div>
</section>




<?php

if (isset($_POST['btn_Modificar'])) {
  $materia = trim($_POST['new_materia']);
  $comision = trim($_POST['new_comision']);
  $aula = trim($_POST['new_aula']);
  $fecha = trim($_POST['new_fecha']);
  $hora = trim($_POST['new_hora']);
  $temas = trim($_POST['new_temas']);
  $novedad = trim($_POST['new_novedad']);
  $archivos = trim($_POST['new_archivo']);
  if (
    strlen($materia) > 0 &&
    strlen($comision) > 0 &&
    strlen($aula) > 0 &&
    strlen($fecha) > 0 &&
    strlen($hora) > 0 &&
    strlen($temas) >= 0 &&
    strlen($novedad) >= 0 &&
    strlen($archivos) >= 0
  ) {
    $consulta = "UPDATE CLASES SET CODIGO_MATERIA = '$id_materia', FECHA ='$fecha', HORA = '$hora', TEMAS = '$temas', NOVEDADES = '$novedad', COMISION = '$comision', AULA = '$aula', ARCHIVOS = '$archivos' 
    WHERE CODIGO_USUARIO = '$id_usuario' AND ID_CLASE= '$valor_checkbox'";
    mysqli_query($conn, $consulta);
    $resultado = mysqli_query($conn, $consulta);
    if ($resultado) {
      return 1;
      // header("Location:index.php");
      // exit();
    } else {
?>
      <h3 class="bad">Ha ocurrido un error</h3>
    <?php
    }
  } else {
    ?>
    <script>
      const $modal3 = document.querySelector(".modal3");
      const bad = document.querySelector(".bad");
      const fondo_modal3 = document.querySelector(".modal3__container");
      const inputs_modal3 = document.querySelectorAll(".inputs-modal");

      $modal3.classList.add("modal3--show");
      fondo_modal3.style.borderColor = "red";
      for (let i = 0; i < inputs_modal3.length; i++) {
        inputs_modal3[i].style.borderColor = "red";
      }
      bad.style.display = "block";
    </script>

<?php
  }
}
?>
