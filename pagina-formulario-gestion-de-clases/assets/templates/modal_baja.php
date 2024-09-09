<section class="modal2">
  <div class="modal2__container">
    <div class="btn-cerrar-modal2"><a href="#" class="modal2__close" title="Cerrar">X</a></div>

    <h2 class="modal2__title">Baja de Clases</h2>
    <p>¿Esta seguro de querer eliminar estas clases?</p>

    <form method="POST"  action="assets/Database/API/api_baja_de_clase.php" >
      <table id="table_modal_baja" class="table_modal_baja">

        <thead class="table_modal_baja__head">
          <tr>
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

        </tbody>

      </table>

      <input type="submit" name="btn_Baja" value="Eliminar" class="btn_form_modal">
      
    </form>
  </div>
</section>


