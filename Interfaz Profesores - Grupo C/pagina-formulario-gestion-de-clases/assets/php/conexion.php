<?php
    try {
        $conexionBD = mysqli_connect("localhost", "root", "", "ppr3_v2");
        if($conexionBD->connect_error){
            throw new Exception("Error de conexión a la BD: " . $conexionBD->connect_error);
        }
    } catch (Exception $error) {
        ?>
            <h5 style="text-align:center; color:red">
                Error de conexión a la BD: <?php echo " " . $error->getMessage(); ?>
            </h5>
        <?php
    }
?>