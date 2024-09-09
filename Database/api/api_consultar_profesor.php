
<?php
//Ver profesores

//Hacer solicitud GET a la API
$api_url = 'http:/localhost/Database/api/api_registro.php';
$response = file_get_contents($api_url);
$users = json_decode($response, true);

//Comprobar si la respuesta es un array 
if(is_array($users)) {
    foreach ($users as $users) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($user['ID']) . "</td>";
        echo "<td>" . htmlspecialchars($user['username']) . "</td>";
        echo "<td>";
        echo "<tr>";
    }
}