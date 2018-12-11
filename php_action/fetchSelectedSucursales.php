<?php 	

require_once '../config/core.php';

$sucursalesId = $_POST['sucursalesId'];

$sql = "SELECT sucursales_id, sucursales_name, sucursales_status, sucursales_creditos FROM sucursales WHERE sucursales_id = $sucursalesId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);