<?php 	

require_once '../config/core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$pedidoSucursalId = $_POST['pedidoSucursalId'];

if($pedidoSucursalId) { 

	$sql1 = "SELECT total, detalle FROM pedido_sucursal WHERE pedido_sucursal_id = '$pedidoSucursalId'";

	$result = $connect->query($sql1);
	if($result->num_rows > 0) { 
		$row = $result->fetch_array();

		$sql = "UPDATE pedido_sucursal SET pedido_sucursal_status = 2 WHERE pedido_sucursal_id = {$pedidoSucursalId}";

		$orderProd = "UPDATE pedido_producto_sucursal SET pedido_producto_sucursal_status = 2 WHERE  pedido_sucursal_id = {$pedidoSucursalId}";

		if($connect->query($sql) === TRUE && $connect->query($orderProd) === TRUE) {
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