<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	
	$stocId = $_POST['stockPorSucursalId'];
	$solicitadoa = $_POST['sucursalId'];
    $cantidad = $_POST['cantidad']; 
	$pedidopor = $_SESSION['sucursales_id'];

	$sql = "INSERT INTO solicitudes (stock_id, sucursal_solicitud_id, sucursal_pedido_id, cantidad, solicitudes_status) VALUES ('$stocId', '$solicitadoa', '$pedidopor', '$cantidad', 1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Solicitado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido solicitar";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST