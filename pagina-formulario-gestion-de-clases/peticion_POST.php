<?php
// Verificar si se ha recibido una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Leer los datos JSON recibidos
  $json = file_get_contents('php://input');
  // Decodificar los datos JSON en un array asociativo
  $data = json_decode($json, true);

  // Verificar si se recibió correctamente el arrayJSON
  if (isset($data["arrayJSON"])) {
    // Obtener el arrayJSON y decodificarlo nuevamente en un array de PHP
    $array = json_decode($data["arrayJSON"], true);

    // Imprimir el array para verificar que se recibió correctamente
    print_r($array);
    
    // Verificar si la sesión ya está activa
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $_SESSION['CLASES_SELECCIONADAS'] = $array;
    
    echo "Datos recibidos correctamente en peticion_POST.php";
  } else {
    // Si no se recibió el arrayJSON correctamente, responder con un mensaje de error
    http_response_code(400);
    echo "No se recibió el JSON correctamente.";
  }
} else {
  // Si no se recibió una solicitud POST, responder con un mensaje de error
  http_response_code(405);
  echo "Método no permitido. Esta página solo acepta solicitudes POST.";
}
