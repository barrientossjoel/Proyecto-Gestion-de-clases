<section class="modal3">
  <div class="modal3__container">
    <div class="btn-cerrar-modal3"><a href="#" class="modal3__close" title="Cerrar">X</a></div>

      <h2 class="modal__title3">Modificacion de Clase</h2>

      <form method="post" action="assets/Database/API/api_modificacion_de_clase.php">
        <label for="new-materia-id">
          Materia
          <select class="inputs-modal mod_materia" name="new_materia" id="new-materia-id" required>
            <option hidden value="" class="op-materia " id="op-principal-materia"></option>
            <?php obtenerMaterias($conn); ?>
          </select>
        </label>

        <label for="new-comision-id">
          Comisión
          <select class="inputs-modal mod_comision" name="new_comision" id="new-comision-id" required>
            <option value="" class="op-comision " hidden id="op-principal-comision" ></option>
            <option value="1ro1ra">1ro1ra</option>
            <option value="1ro2da">1ro2da</option>
            <option value="1ro3ra">1ro3ra</option>
            <option value="2do1ra">2do1ra</option>
            <option value="2do2da">2do2da</option>
            <option value="3ro1ra">3ro1ra</option>
            <option value="3ro2da">3ro2da</option>
          </select>
        </label>

        <label for="new-aula-id">
          Aula:
          <input value="" type="number" min="1" max=100 placeholder="Ingrese número de aula" id="new-aula-id" class="inputs-modal" name="new_aula" required >
        </label>

        <label for="new-hora-id">
          Hora
          <select class="inputs-modal mod_hora" name="new_hora" id="new-hora-id" required>
            <option hidden value="" class="op-hora " id="op-principal-hora"></option>
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
          <input class="inputs-modal mod_fecha" id="new-fecha-id" type="date" name="new_fecha" value="" required>
        </label>

        <textarea name="new_temas" maxlength="50" rows="2" placeholder="Ingresá una tarea" id="temas-id" class="textarea-form-class" required></textarea>

        <textarea name="new_novedad" maxlength="50" rows="2" placeholder="¿Alguna Novedad?" id="novedad-id" class="textarea-form-class" required></textarea>

        <label for="archivo_actual" class="form-label">
          Archivo actual: 
        </label>
        <!-- <php if (!empty($archivos)) : ?>
          <div class="container">
            <a href="descargar_archivo.php?nombre=<php echo $archivos; ?>" target="_blank">Descargar archivo</a><br>
            <a href="eliminar_archivo.php?nombre=<php echo $archivos; ?>">Eliminar archivo</a><br>
          </div>
        <php endif; ?> -->
        <input type="file" class="form-control" name="new_archivo" id="archivo_actual"  aria-describedby="fileHelpId" />

        <input type="submit" name="btn_Modificar" value="Actualizar" class="btn_form_modal">

      </form>
      
    <h3 class="bad">¡Por favor complete los campos indicados de manera correcta! </h3>

  </div>
</section>



