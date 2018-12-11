<?php


require_once '../config/db_connect.php';

$sql = "SELECT o.order_id, o.client_name, o.order_date FROM orders o WHERE o.order_status = 1 AND o.order_date = CURDATE()";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 
	while($row = $result->fetch_array()) {

		$sql2 = "INSERT INTO notifications (orders_id, sucursales_id,  notifications_date) VALUES ('$row[0]', '$row[1]', '$row[2]')";

		$connect->query($sql2);

	} // /while 

} // if num_rows

$connect->close();

?>