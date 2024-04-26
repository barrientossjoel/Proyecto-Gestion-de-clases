<?php
if (isset($_SESSION['Array_valores_checkbox'])) {
    $valores_checkbox = $_SESSION['Array_valores_checkbox'];
    $valor_checkbox = implode("", $valores_checkbox); //Lo convierto a String
    $id_usuario = $_SESSION["id"];

    $consulta = "SELECT * FROM clases WHERE CODIGO_USUARIO = '$id_usuario' and ID_CLASE = '$valor_checkbox'";
    $resultado = mysqli_query($conexionBD, $consulta);
    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_array($resultado);

        $id_materia = $fila['CODIGO_MATERIA'];
        $comision = $fila['COMISION'];
        $hora = $fila['HORA'];
        $fecha = $fila['FECHA'];
        $aula = $fila['AULA'];
        $archivo = $fila['ARCHIVOS'];
        $temas = $fila['TEMAS'];
        $novedades = $fila['NOVEDADES'];
    }
}
?>



<section class="modal3">
    <div class="modal3__container">
        <div class="btn-cerrar-modal3"><a href="#" class="modal3__close" title="Cerrar">X</a></div>

        <h2 class="modal__title3">Modificacion de Clase</h2>
        <h3 class="bad">¡Por favor complete los campos indicados de manera correcta! </h3>

        <form method="post">
            <label>
                Materia
                <select class="inputs-modal mod_materia" name="new_materia">
                    <option value="<?php echo $id_materia; ?>" hidden class="op-materia hidden">Seleccione la materia</option>
                </select>
            </label>

            <label>
                Comision
                <select class="inputs-modal mod_comision" name="new_comision">
                    <option value="<?php echo $comision; ?>" hidden class="op-comision hidden">Seleccione la comision</option>
                </select>
            </label>

            <label>
                Hora
                <select class="inputs-modal mod_hora" name="new_hora">
                    <option value="<?php echo $hora; ?>" hidden class="op-hora hidden">Seleccione hora</option>
                </select>
            </label>

            <label>
                Fecha
                <input class="inputs-modal mod_fecha" type="date" name="new_fecha" value="<?php echo $fecha; ?>">
            </label>

            <label>
                Aula
                <input class="inputs-modal mod_aula" placeholder="Ingrese numero de aula" value="<?php echo $aula; ?>" min="1" max="100" type="number" name="new_aula">
            </label>

            <label>Subir nuevo archivo
                <input type="file" class="inputs-modal mod_archivo" name="new_archivo" id="" placeholder="Ingrese nuevo archivo" aria-describedby="fileHelpId" value="<?php echo $archivo; ?>" />
            </label>

            <textarea name="new_temas" maxlength="50" rows="2" placeholder="Ingresá una tarea" class="textarea-form-class"><?php echo $temas; ?></textarea>

            <textarea name="new_novedad" maxlength="50" rows="2" placeholder="¿Alguna Novedad?" class="textarea-form-class"><?php echo $novedades; ?></textarea>

            <input type="submit" name="btn_Modificar" value="Actualizar" class="btn_añadir">
        </form>
    </div>
</section>

<?php
if (isset($_POST['btn_Modificar'])) {
    $aula = trim($_POST['new_aula']);
    $aula_entero = intval($aula);
    if (
        strlen($_POST['new_materia']) >= 1 &&
        strlen($_POST['new_comision']) > 0 &&
        strlen($_POST['new_fecha']) > 0 &&
        strlen($_POST['new_hora']) > 0 &&
        strlen($_POST['new_aula']) > 0 &&
        ($aula == $aula_entero) &&
        strlen($_POST['new_archivo']) >= 0 &&
        strlen($_POST['new_temas']) >= 0 &&
        strlen($_POST['new_novedad']) >= 0
    ) {
        $id_usuario = $_SESSION["id"];
        $materia = trim($_POST['new_materia']);
        $comision = trim($_POST['new_comision']);
        $fecha = trim($_POST['new_fecha']);
        $hora = trim($_POST['new_hora']);
        $aula = trim($_POST['new_aula']);
        $archivo = trim($_POST['new_archivo']);
        $temas = trim($_POST['new_temas']);
        $novedad = trim($_POST['new_novedad']);
        $consulta = "UPDATE clases set CODIGO_MATERIA='$materia', COMISION='$comision', FECHA='$fecha', HORA='$hora', AULA='$aula', ARCHIVOS='$archivo', TEMAS='$temas', NOVEDADES='$novedad' 
            WHERE CODIGO_USUARIO='$id_usuario' 
            and ID_CLASE='$valor_checkbox'";
        mysqli_query($conexionBD, $consulta);
        $resultado = mysqli_query($conexionBD, $consulta);
    } else {
?>
        <script>
            const $modal3 = document.querySelector(".modal3");
            const bad = document.querySelector(".bad");
            const fondo_modal_mdn = document.querySelector(".modal3__container");
            const inputs_modal = document.querySelectorAll(".inputs-modal");

            $modal3.classList.add("modal3--show");
            fondo_modal_mdn.style.borderColor = "red";
            for (let i = 0; i < inputs_modal.length; i++) {
                inputs_modal[i].style.borderColor = "red";
            }
            bad.style.display = "block";
        </script>
<?php
    }
}
?>