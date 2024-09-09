<section class="modal">
  <div class="modal__container">
    <div class="btn-cerrar-modal"> <a href="#" class="modal__close" title="Cerrar">X</a> </div>

      <h2 class="modal__title">Alta de Clase</h2>

      <form method="post" action="assets/Database/API/api_alta_de_clase.php">

        <label for="materia-id">
          Materia
          <select  class="inputs-modal" name="materia" id="materia-id" required >
            <option hidden value="">Seleccione la materia</option>
            <?php obtenerMaterias($conn); ?>
          </select>
        </label>

        <label for="comision-id">
          Comision
          <select class="inputs-modal" name="comision" id="comision-id" required>
            <option hidden value="">Seleccione la comision</option>
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
          <input type="number" min="1" max=100 placeholder="Ingrese número de aula" class="inputs-modal" name="aula" id="aula-id" required>
        </label>

        <label for="hora-id">
          Hora
          <select class="inputs-modal" name="hora" id="hora-id" required>
            <option hidden value="">Seleccione hora</option>
            <option value="8:00-10:00">8:00-10:00</option>
            <option value="10:10-12:00">10:10-12:00</option>
            <option value="8:00-12:00">8:00-12:00</option>
            <option value="18:00-20:00">18:00-20:00</option>
            <option value="20:10-22:00">20:10-22:00</option>
            <option value="18:00-22:00">18:00-22:00</option>
          </select>
        </label>

        <label for="fecha-id">
          Fecha
          <input class="inputs-modal" type="date" name="fecha" id="fecha-id"  value="<?php echo date('Y-m-d'); ?>" required>
        </label>

        <textarea required name="temas" maxlength="100" rows="2" placeholder="Ingresá una tarea" class="textarea-form-class"></textarea>

        <textarea required name="novedad" maxlength="100" rows="2" placeholder="¿Alguna Novedad?" class="textarea-form-class"></textarea>

        <label for="file-id" class="form-label">Subir algún archivo</label>
        <input type="file" class="form-control" name="archivo" id="file-id"  aria-describedby="fileHelpId" />



        <input type="submit" name="btn_Añadir" value="Añadir" class="btn_form_modal">

      </form>

    <h3 class="bad">¡Por favor complete los campos de manera correcta!</h3>
    
  </div>

</section>


