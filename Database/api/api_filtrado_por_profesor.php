<?php
//Headers
header("Content-Type: application/json");
header("Acces-Control-Allow-Origin: *");
header("Acces-Control-Allow-Methods: POST, GET");
header("Acces-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Manejar solicitud
$request_method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];

switch ($request_method){
    case 'GET':
        handleGetRequest($conn, $request_uri);
        break;
    case 'POST':
        handlePostRequest($conn, $request_uri);
        break;
    case 'PUT':
        handlePutRequest($conn, $request_uri);
        break;
    case 'DELETE':
        handleDeleteRequest($conn, $request_uri);
        break;
    default;
        http_response_code(405);
        echo json_encode(array('message' => 'Método no permitido'));
        break;
}

function handleGetRequest($conn, $request_uri){
    if (strpos($request_uri, '/api/clases') !== false){
        //Obtener lista de clases
        $sql = "SELECT ID, materia, profesor, FROM clases";
        $result = $conn->query($sql);
        $clases = array();
        while ($row = $result->fetch_assoc()){
            $clases [] = $row;
        }
        echo json_encode($clases);
    } else {
        http_response_code(404);
        echo json_encode(array('message' => 'Recurso no encontrado'));
    }
}