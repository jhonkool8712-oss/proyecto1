<?php
header("Content-Type: application/json");

$conn = new mysqli("jhonatan1_proyecto", "jhonathan1", "clase123", "gestion_usuarios");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

case 'GET':
    $res = $conn->query("SELECT * FROM usuarios");
    $data = [];
    while($row = $res->fetch_assoc()){
        $data[] = $row;
    }
    echo json_encode($data);
break;

case 'POST':
    $d = json_decode(file_get_contents("php://input"), true);
    $conn->query("INSERT INTO usuarios(nombre,cedula,telefono)
                  VALUES('$d[nombre]','$d[cedula]','$d[telefono]')");
break;

case 'PUT':
    $d = json_decode(file_get_contents("php://input"), true);
    $conn->query("UPDATE usuarios SET 
        nombre='$d[nombre]',
        cedula='$d[cedula]',
        telefono='$d[telefono]'
        WHERE id=$d[id]");
break;

case 'DELETE':
    $d = json_decode(file_get_contents("php://input"), true);
    $conn->query("DELETE FROM usuarios WHERE id=$d[id]");
break;
}
?>