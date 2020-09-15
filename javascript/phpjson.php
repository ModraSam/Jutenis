<?php 

header("Access-Control-Allow-Origin: *");

$data = file_get_contents('php://input');

$data = json_decode($data, true);

$correo = explode("@", $data["correo"]);

$datos["nombre"] = $correo[0];

echo json_encode($datos, true);

?>