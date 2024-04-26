<section class="modal2">
  <div class="modal2__container">
    <div class="btn-cerrar-modal2"><a href="#" class="modal2__close" title="Cerrar">X</a></div>
    
    <h2 class="modal2__title">Baja de Clases</h2>
    <p>¿Está seguro de querer eliminar estas clases?</p>
        
    <form method="POST">
      <table>
        <thead>
          <tr>
            <th class="materia">Materia</th>
            <th class="comision">Comisión</th>
            <th class="hora">Hora</th>
            <th class="fecha">Fecha</th>
            <th class="temas">Temas</th>
            <th class="novedades">Novedades</th>
          </tr>
        </thead>

        <tbody>
          <?php
            if(isset($_SESSION['Array_valores_checkbox'])) {
              $valores_checkbox = $_SESSION['Array_valores_checkbox'];

              $consulta = "SELECT materias.NOMBRE,clases.COMISION,clases.FECHA,clases.HORA,clases.TEMAS,clases.NOVEDADES
              FROM clases , usuario , materias  
              WHERE clases.CODIGO_USUARIO =   usuario.CODIGO 
              and clases.CODIGO_MATERIA = materias.CODIGO 
              and clases.ID_CLASE IN (";
              $consulta .= str_repeat("?,", count($valores_checkbox) - 1) . "?"; //El "?," se repite la cantidad de posiciones que tiene valores_checkbox -1 y luego lo concatena con un ultimo "?" .
                
              $consulta .= ")"; //Cierro la consulta.
              $stmt = $conexionBD->prepare($consulta);   //$stmt : Sentecia Preparada.
                
              $stmt->bind_param(str_repeat("i", count($valores_checkbox)), ...$valores_checkbox);
              // el "i" se refiere a que solo permite numeros enteros.
              // se repite la cantidad de posiciones que tiene $valores_checkbox.
              // ...$valores_checkbox: Pone en los ? los valores de cada posicion del array .
              
              $stmt->execute(); //Ejecuto la consulta.

              $resultado = $stmt->get_result();  // Devuelve el resultado de la consulta y luego lo guardo en $resultado.
              

              if(isset($resultado)&& $resultado->num_rows>0){
                while($fila=$resultado->fetch_assoc()){ 
                  ?>
                    <tr>
                      <td><?php echo $fila['NOMBRE']; ?></td>
                      <td><?php echo $fila['COMISION']; ?></td>
                      <td><?php echo $fila['HORA']; ?></td>
                      <td><?php echo $fila['FECHA']; ?></td>
                      <td><textarea class="td_textarea" rows="1" readonly><?php echo $fila['TEMAS']; ?></textarea></td>
                      <td><textarea class="td_textarea" rows="1" readonly><?php echo $fila['NOVEDADES']; ?></textarea></td>
                    </tr>
                  <?php
                }
              }
              else{
                echo"<tr><td colspan='6' style='font-size:20px;'>No Se Encontraron Resultados.</td></tr>";
              }  
            } 
            else{
              echo"<tr><td colspan='6' style='font-size:20px;'>No Se Encontraron Resultados.</td></tr>";
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
  $consulta = "DELETE FROM clases where id_clase IN (";
  $consulta .= str_repeat("?,", count($valores_checkbox) - 1) . "?"; //El "?," se repite la cantidad de posiciones que tiene valores_checkbox -1 y luego lo concatena con un ultimo "?" .
  
  $consulta .= ")"; //Cierro la consulta.
  $stmt = $conexionBD->prepare($consulta);   //$stmt : Sentecia Preparada.
  
  $stmt->bind_param(str_repeat("i", count($valores_checkbox)), ...$valores_checkbox);

  $stmt->execute(); //Ejecuto la consulta.
}
?>
