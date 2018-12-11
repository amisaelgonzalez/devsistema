<?php 	

require_once '../config/core.php';

$usersAdId = $_POST['usersAdId'];

$sql = "SELECT user_id, username, email, rol, sucursales_id FROM users WHERE user_id = $usersAdId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);