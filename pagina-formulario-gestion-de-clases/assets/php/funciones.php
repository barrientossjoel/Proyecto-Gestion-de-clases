
<?php
/* --- Seccion de funciones de index ---  */
function bienvenida($conn){
  $queryWelcome = "SELECT NOMBRE_PERSONA, APELLIDO_PERSONA, CARGO FROM PERSONAS WHERE CARGO = 'Profesor'";
  $res_queryWelcome = mysqli_query($conn, $queryWelcome);
  ?>
  <p class="msg-bienvenida">
  <?php
  if ($res_queryWelcome) {
    $fila_welcome = mysqli_fetch_assoc($res_queryWelcome);
  ?>
  <?php echo $fila_welcome['NOMBRE_PERSONA'] . " " . $fila_welcome['APELLIDO_PERSONA']; ?> 
    <span style="font-weight: bold; color:darkorange;">
      (<?php echo $fila_welcome['CARGO']; ?>)
    </span>
  </p>        
  <?php
  } 
  else {
    echo "Hubo un error al hacer la consulta de Bienvenida: " . mysqli_error($conn);
  }
}
?>

<?php
function mostrarDatos($result){
  if (isset($result) && $result->num_rows > 0) {
    $id_clase_chkbx = null;
    while ($fila = mysqli_fetch_array($result)) {
      $id_clase_chkbx = $fila['ID_CLASE']; 
      ?>
      <tr>
          <td class="columna-checkbox" ><input class="input-checkbox-register" type="checkbox" name="seleccionar_registro" value="<?php echo $id_clase_chkbx; ?>"></td>
          <td class="td_hidden"><?php echo $fila['CODIGO_MATERIA']; ?></td>
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
    }
  } 
  else {
    echo "<tr><td colspan='9' style='font-size:20px;'>No se encontró ninguna clase registrada...</td></tr>";
  }
}
?>


<?php
function buscarClases($conn){
  $queryBuscarClases = "SELECT materias.NOMBRE_MATERIA, clases.CODIGO_MATERIA
  FROM clases, usuarios, materias, usuxrol
  WHERE clases.CODIGO_USUARIO = usuarios.CODIGO_USUARIO
  AND clases.CODIGO_MATERIA = materias.CODIGO_MATERIA
  AND usuxrol.CODIGO_USUARIO = clases.CODIGO_USUARIO
  GROUP BY materias.NOMBRE_MATERIA";

  $res_queryBuscarClases = mysqli_query($conn, $queryBuscarClases);
  if ($res_queryBuscarClases->num_rows > 0){
    while ($fila = $res_queryBuscarClases->fetch_assoc()) {
      $claseID = $fila['CODIGO_MATERIA'];
      $queryClasesDelUsuario = "SELECT clases.ID_CLASE,clases.CODIGO_MATERIA,materias.NOMBRE_MATERIA,clases.COMISION, 
      clases.AULA, clases.HORA,clases.FECHA,clases.TEMAS, clases.NOVEDADES,clases.ARCHIVOS
      FROM clases, usuarios, materias, usuxrol
      WHERE clases.CODIGO_USUARIO = usuarios.CODIGO_USUARIO
      AND clases.CODIGO_MATERIA = materias.CODIGO_MATERIA
      AND clases.CODIGO_MATERIA = $claseID
      AND usuxrol.CODIGO_USUARIO = clases.CODIGO_USUARIO";
      $res_queryClasesDelUsuario  = mysqli_query($conn, $queryClasesDelUsuario);
      
      if ($res_queryClasesDelUsuario->num_rows > 1){ 
        ?>
        <label class="contenedor-materia">
          <input  class="checkLabel" type="checkbox" >
          <div class="titulo-materia">
            <b><?php echo $fila['NOMBRE_MATERIA']; ?></b>
          </div>
            <div class="datos-materia">
              <table class="table_principal-body">
                <tbody id="tableBody">
                  <?php mostrarDatos($res_queryClasesDelUsuario);?>
                </tbody>
              </table>
            </div>
        </label>   
        <?php
      }
      else if ($res_queryClasesDelUsuario->num_rows == 1) {
        ?>
        <table class="table_principal-body">
          <tbody>
            <?php mostrarDatos($res_queryClasesDelUsuario); ?>
          </tbody>
        </table>
        <?php
      }
    }
  }    
  else{
    ?>
    <table>
      <tr><td colspan='9' style='font-size:20px;'>No se encontró ninguna clase registrada...</td></tr>
    </table>
    <?php
  }
}
?>


<?php
/* --- Seccion de funciones de Modal Alta ---  */

function obtenerMaterias($conn){
  $queryobtenerMaterias = "SELECT MATERIAS.NOMBRE_MATERIA, MATERIAS.CODIGO_MATERIA FROM materias";
  $res_queryobtenerMaterias = mysqli_query($conn, $queryobtenerMaterias);
  if ($res_queryobtenerMaterias) {
    while ($fila_materia = mysqli_fetch_assoc($res_queryobtenerMaterias)) { 
      ?>
        <option value="<?php echo $fila_materia['CODIGO_MATERIA']; ?>">
          <?php echo $fila_materia['NOMBRE_MATERIA']; ?>
        </option>
      <?php
    }
  } 
  else {
    echo "Error al ejecutar la consulta de Seleccionar Materias: " . mysqli_error($conn);
  }
}
?>


<?php
function altaDeClase($conn, $id_usuario, $id_materia, $comision, $aula, $fecha, $hora, $temas, $novedad, $archivos){
  $queryAltaClase = "INSERT INTO CLASES(CODIGO_USUARIO, CODIGO_MATERIA, FECHA, HORA, TEMAS, NOVEDADES, COMISION, AULA, ARCHIVOS) VALUES ('$id_usuario','$id_materia','$fecha','$hora','$temas','$novedad','$comision','$aula', '$archivos')";
  $res_queryAltaClase = mysqli_query($conn, $queryAltaClase);
  
  if ($res_queryAltaClase) {    
    header("Content-Type: text/html; charset=UTF-8");
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Redirigiendo...</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/modal.css">
        <link rel="icon" href="assets/img/icono.png">
    </head>
    <body>
      <div class="bg-body-style">
      <div class="notificacion-container">
        <div class="notificacion-mensaje-box">
          <div class="notificacion-icon-container container-icon-alta">
            <div class="notificacion-icon icon-alta">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="notificacion-svg-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
              </svg>
            </div>
          </div>
            <h3 class="notificacion-heading">¡Éxito!</h3>
            <p class="notificacion-text">¡La clase se agregó correctamente!</p>
        </div>
      </div>
      </div>
      <script>
        setTimeout(() => {
          window.location.href = "../../../index.php"; }, 1000);
      </script>
    </body>
    </html>';
  } 
  else { 
    // http_response_code(500); // Error interno del servidor
    // echo json_encode(array('message' => 'Error al dar alta de clase: ' . $conn->error));  
    //<script>  console.error("hay un error con el boton Alta: no se envian los datos mediante el servidor a la bd")  </script>
    header("Content-Type: text/html; charset=UTF-8"); 
    echo '<h3 class="bad">¡Ups ha ocurrido un error!</h3>';
  }
}
?>


<?php
/* --- Seccion de funciones del Modal Modificacion ---  */

function modificacionDeClase($conn, $id_usuario, $id_materia, $comision, $aula, $fecha, $hora, $temas, $novedad, $archivos){
  if (isset($_SESSION['CLASES_SELECCIONADAS'])) {
    $clase_seleccionada = $_SESSION['CLASES_SELECCIONADAS'];
    $clase_seleccionada = implode("", $clase_seleccionada);

    $queryModificacionClase = "UPDATE CLASES SET CODIGO_MATERIA = '$id_materia', FECHA ='$fecha', HORA = '$hora', TEMAS = '$temas', NOVEDADES = '$novedad', COMISION = '$comision', 
    AULA = '$aula', ARCHIVOS = '$archivos' WHERE CODIGO_USUARIO = '$id_usuario' AND ID_CLASE= '$clase_seleccionada' ";
    $res_queryModificacionClase = mysqli_query($conn, $queryModificacionClase);

    if ($res_queryModificacionClase) {    
      header("Content-Type: text/html; charset=UTF-8");
      echo ' 
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Redirigiendo...</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/modal.css">
        <link rel="icon" href="assets/img/icono.png">
      </head>
      <body >
        <div class="bg-body-style">
        <div class="notificacion-container">
          <div class="notificacion-mensaje-box">
            <div class="notificacion-icon-container container-icon-alta">
              <div class="notificacion-icon icon-alta">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="notificacion-svg-icon">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
              </div>
            </div>
            <h3 class="notificacion-heading">¡Éxito!</h3>
            <p class="notificacion-text">¡La clase se modifico correctamente!</p>
          </div>
        </div>
        </div>
        <script>
        setTimeout(() => {
          window.location.href = "../../../index.php"; }, 1000);
        </script>
      </body>
      </html>';
    } 
    else { 
      // http_response_code(500); // Error interno del servidor
      // echo json_encode(array('message' => 'Error al dar alta de clase: ' . $conn->error));  
      //<script>  console.error("hay un error con el boton Alta: no se envian los datos mediante el servidor a la bd")  </script>
      header("Content-Type: text/html; charset=UTF-8"); 
      echo '<h3 class="bad">¡Ups ha ocurrido un error!</h3>';
    }
  }
}
?>


<?php
/* --- Seccion de funciones ded Modal Baja ---  */

function bajaDeClase($conn, $id_usuario, $clases_seleccionadas ){
  if (is_array($clases_seleccionadas)) {
    $queryBajaClase = "DELETE FROM CLASES WHERE ID_CLASE = ? AND CODIGO_USUARIO = ?";
    $stmt = $conn->prepare($queryBajaClase);
    if ($stmt) {
      
      $contador = 0;
      
      foreach ($clases_seleccionadas as $id_clase) {
        $stmt->bind_param("is", $id_clase, $id_usuario);
        $stmt->execute();
        $contador++;
      }

      if ($stmt->affected_rows > 0) {
        header("Content-Type: text/html; charset=UTF-8");

        if($contador == 1){
          $mensajeExito= '<p class="notificacion-text">¡La clase se está eliminando!</p>';
          $mensajeError= '"<tr><td colspan="6" style="font-size:20px";>No se ha podido eliminar la clase.</td></tr>"';
        }
        else{
          $mensajeExito= '<p class="notificacion-text">¡Las clases se están eliminando!</p>';
          $mensajeError= '"<tr><td colspan="6" style="font-size:20px";>No se han podido eliminar las clases.</td></tr>"';
        }
          
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Eliminando...</title>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
          <link rel="stylesheet" href="../../css/style.css">
          <link rel="stylesheet" href="../../css/modal.css">
          <link rel="icon" href="assets/img/icono.png">
        </head>
        <body >
          <div class="bg-body-style">
          <div class="notificacion-container">
            <div class="notificacion-mensaje-box">
              <div class="notificacion-icon-container container-icon-eliminar">
                <div class="notificacion-icon icon-eliminar ">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="notificacion-svg-icon">
                    <path fill="#ffffff" d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64V75c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437v11c-17.7 0-32 14.3-32 32s14.3 32 32 32H64 320h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V437c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H320 64 32zM288 437v11H96V437c0-25.5 10.1-49.9 28.1-67.9L192 301.3l67.9 67.9c18 18 28.1 42.4 28.1 67.9z"/>
                  </svg>
                </div>
              </div>
              <h3 class="notificacion-heading">Eliminado...</h3>
              '.$mensajeExito.'
            </div>
          </div>
          </div>
          <script>
            setTimeout(() => {
            window.location.href = "../../../index.php"; }, 2000);
          </script>
        </body>
        </html>';
        unset($_SESSION['CLASES_SELECCIONADAS']);
      }
      else {
        header("Content-Type: text/html; charset=UTF-8"); 
        echo "<tr><td colspan='6' style='font-size:20px';>No se han podido eliminar las clases.</td></tr>"; 
      }
      $stmt->close();
    } 
    else {
      header("Content-Type: text/html; charset=UTF-8"); 
      echo $mensajeError;
    }
  } 
  else { 
    // http_response_code(500); // Error interno del servidor
    // echo json_encode(array('message' => 'Error al dar alta de clase: ' . $conn->error));  
    //<script>  console.error("hay un error con el boton Alta: no se envian los datos mediante el servidor a la bd")  </script>
    header("Content-Type: text/html; charset=UTF-8"); 
    echo '<h3 class="bad">No se han seleccionado clases para eliminar</h3>';
  }
}
?>
