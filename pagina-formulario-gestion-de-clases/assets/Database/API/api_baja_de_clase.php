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
    if (isset($_SESSION['CLASES_SELECCIONADAS'])) {
        $clases_seleccionadas = $_SESSION['CLASES_SELECCIONADAS'];
        $id_usuario = $_SESSION['CODIGO_USUARIO'];
    
        bajaDeClase($conn, $id_usuario, $clases_seleccionadas);
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


?>
