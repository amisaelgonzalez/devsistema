<?php 	

require_once '../config/core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$orderId = $_POST['orderId'];

if($orderId) { 

	$sql1 = "SELECT total_amount, client_name FROM orders WHERE order_id = '$orderId'";

	$result = $connect->query($sql1);
	if($result->num_rows > 0) { 
		$row = $result->fetch_array();

		$sql = "UPDATE orders SET order_status = 2 WHERE order_id = {$orderId}";

		$sql2 = "UPDATE sucursales SET sucursales_creditos = sucursales_creditos+'$row[0]' WHERE sucursales_id='$row[1]'";

		$orderItem = "UPDATE order_item SET order_item_status = 2 WHERE  order_id = {$orderId}";

		if($connect->query($sql) === TRUE && $connect->query($sql2) === TRUE && $connect->query($orderItem) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "Eliminado exitosamente";		
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error no se ha podido eliminar";
		}
	}
$connect->close();

echo json_encode($valid);
 
} // /if $_POST