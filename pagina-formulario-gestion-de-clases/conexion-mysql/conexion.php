<?php

/**Conexion a Base de Datos**/
$servidor = "sql309.byethost7.com";
$basededatos = "b7_36409925_SAU";
$usuario  = "b7_36409925";
$password = "gestionPP3";

$conn = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");
$db = mysqli_select_db($conn, $basededatos) or die("Upps! Error en conectar a la Base de Datos");



?>

