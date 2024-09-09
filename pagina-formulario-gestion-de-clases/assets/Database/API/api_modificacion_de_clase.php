<?php
//Headers
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("../../php/conexion.php");
include("../../php/funciones.php");
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar la sesión si no está activa
}

// Manejar Solicitud
$request_method = $_SERVER['REQUEST_METHOD'];

if($request_method === 'POST'){
    $id_usuario = $_SESSION["CODIGO_USUARIO"] ;
    $id_materia= trim($_POST['new_materia']);
    $comision = trim($_POST['new_comision']);
    $aula = trim($_POST['new_aula']);
    $fecha = trim($_POST['new_fecha']);
    $hora = trim($_POST['new_hora']);
    $temas = trim($_POST['new_temas']);
    $novedad = trim($_POST['new_novedad']);
    $archivos = trim($_POST['new_archivo']);
    
    if (!empty($id_materia) && !empty($comision) && !empty($aula) && !empty($fecha) && !empty($hora) && !empty($temas) && !empty($novedad) ) {
        modificacionDeClase($conn, $id_usuario, $id_materia, $comision, $aula, $fecha, $hora, $temas, $novedad, $archivos);
        exit();

    }
    else{   
        http_response_code(400);  //Solicitud incorrecta
        // echo json_encode(array('message' ->'Por favor, proporciona los campos requeridos.'));
        // exit;
        $_SESSION['message'] = ['type' => 'error'];
        header("Location: ../../../index.php");
        exit();
    }

}

$conn->close();


?>