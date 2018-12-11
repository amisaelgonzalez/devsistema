<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$pedidoName = $_POST['pedidoName'];
	$brandName 	= $_POST['brandName'];

	$sql = "INSERT INTO pedidos (pedido_id, pedido_name, brand_id, pedido_status) VALUES (default, '$pedidoName', '$brandName', 1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Creado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido guardar";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST