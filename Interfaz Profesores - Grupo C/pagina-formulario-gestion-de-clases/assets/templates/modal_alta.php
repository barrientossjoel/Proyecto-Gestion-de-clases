<section class="modal">
    <div class="modal__container">
        <div class="btn-cerrar-modal"><a href="#" class="modal__close" title="Cerrar">X</a></div>

        <h2 class="modal__title">Alta de Clase</h2>

        <h3 class="bad">¡Por favor complete los campos indicados de manera correcta! </h3>

        <form method="post">

            <label>
                Materia
                <select class="inputs-modal" name="materia">
                    <option value="" hidden>Seleccione la materia</option>
                    <option value="1">1.Análisis Matemático 1</option>
                    <option value="2">2.Inglés 2</option>
                    <option value="3">3.Prácticas Profesionalizantes 3</option>
                </select>
            </label>

            <label>
                Comision
                <select class="inputs-modal" name="comision">
                    <option value="" hidden>Seleccione la comision</option>
                    <option value="1.º, 1.ª">1.º, 1.ª</option>
                    <option value="1.º, 2.ª">1.º, 2.ª</option>
                    <option value="1.º, 3.ª">1.º, 3.ª</option>
                </select>
            </label>

            <label>
                Hora
                <select class="inputs-modal " name="hora">
                    <option value="" hidden>Seleccione hora</option>
                    <option value="8:00-10:00">8:00-10:00</option>
                    <option value="10:10-12:00">10:10-12:00</option>
                    <option value="8:00-12:00">8:00-12:00</option>
                    <option value="18:00-22:00">18:00-22:00</option>
                    <option value="20:10-22:00">20:10-22:00</option>
                    <option value="18:00-20:00">18:00-20:00</option>
                </select>
            </label>

            <label>
                Fecha
                <input class="inputs-modal" type="date" name="fecha">
            </label>

            <label>
                Aula
                <input class="inputs-modal" placeholder="Ingrese numero de aula" min="1" max="100" type="number" name="aula">
            </label>

            <label>Subir algún archivo
                <input type="file" class="inputs-modal" name="archivo" id="" placeholder="" aria-describedby="fileHelpId" />
            </label>

            <textarea name="temas" maxlength="50" rows="2" placeholder="Ingresá una tarea" class="textarea-form-class"></textarea>

            <textarea name="novedad" maxlength="50" rows="2" placeholder="¿Alguna Novedad?" class="textarea-form-class"></textarea>

            <input type="submit" name="btn_Añadir" value="Añadir" class="btn_añadir">
        </form>
    </div>
</section>

<?php

if (isset($_POST['btn_Añadir'])) {
    $aula = trim($_POST['aula']);
    $aula_entero = intval($aula);
    if (
        strlen($_POST['materia']) >= 1 &&
        strlen($_POST['comision']) > 0 &&
        strlen($_POST['fecha']) > 0 &&
        strlen($_POST['hora']) > 0 &&
        strlen($_POST['aula']) > 0 &&
        ($aula == $aula_entero) &&
        strlen($_POST['archivo']) >= 0 &&
        strlen($_POST['temas']) >= 0 &&
        strlen($_POST['novedad']) >= 0
    ) {
        $id_usuario = $_SESSION["id"];
        $materia = trim($_POST['materia']);
        $comision = trim($_POST['comision']);
        $fecha = trim($_POST['fecha']);
        $hora = trim($_POST['hora']);
        $aula = trim($_POST['aula']);
        $archivo = trim($_POST['archivo']);
        $temas = trim($_POST['temas']);
        $novedad = trim($_POST['novedad']);
        $consulta = "INSERT INTO clases(CODIGO_USUARIO,CODIGO_MATERIA,COMISION,FECHA,HORA,AULA,ARCHIVOS,TEMAS,NOVEDADES) VALUES ('$id_usuario','$materia','$comision','$fecha','$hora','$aula','$archivo','$temas','$novedad')";
        $resultado = mysqli_query($conexionBD, $consulta);
        if ($resultado) {
            header("Location:index.php");
        } else {
        ?>
            <h3 class="bad">¡Ups ha ocurrido un error! </h3>
        <?php
        }
    } else {
        ?>
        <script>
            const $modal = document.querySelector(".modal");
            const bad = document.querySelector(".bad");
            const fondo_modal = document.querySelector(".modal__container");
            const inputs_modal = document.querySelectorAll(".inputs-modal");

            $modal.classList.add("modal--show");
            fondo_modal.style.borderColor = "red";
            for (let i = 0; i < inputs_modal.length; i++) {
                inputs_modal[i].style.borderColor = "red";
            }
            bad.style.display = "block";
        </script>
        <?php
    }
}
?>