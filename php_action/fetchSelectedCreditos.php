<?php 	

require_once '../config/core.php';

$creditosId = $_POST['creditosId'];

$sql = "SELECT creditos_id, sucursales_id, creditos_cantidad, creditos_fecha_limite FROM creditos WHERE creditos_id = $creditosId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);