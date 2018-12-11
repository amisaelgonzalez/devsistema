<?php 	

require_once '../config/core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$orderId = $_POST['orderId'];

if($orderId) { 

	$sql = "UPDATE orders_user SET order_status = 2 WHERE order_id = {$orderId}";

	$orderItem = "UPDATE order_user_item SET order_item_status = 2 WHERE  order_id = {$orderId}";

	if($connect->query($sql) === TRUE && $connect->query($orderItem) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Eliminado exitosamente";		
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error no se ha podido eliminar";
	}

$connect->close();

echo json_encode($valid);
 
} // /if $_POST