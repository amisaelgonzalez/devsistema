<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$pedidoSucursalId = $_POST['pedidoSucursalId'];

	$detalle 	= $_POST['detalle'];

	$subTotalValue 	= $_POST['subTotalValue'];
	$vatValue 		= $_POST['vatValue'];
	$totalAmountValue= $_POST['totalAmountValue'];

		
		
	$sql = "UPDATE pedido_sucursal SET detalle = '$detalle', sub_total = '$subTotalValue', vat = '$vatValue', total = '$totalAmountValue', pedido_sucursal_status = 1 WHERE pedido_sucursal_id = {$pedidoSucursalId}";	
	$connect->query($sql);
		
	// remove the pedidoSucursal item data from pedidoSucursal item table
	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$removePedidoSucursalSql = "DELETE FROM pedido_producto_sucursal WHERE pedido_sucursal_id = {$pedidoSucursalId}";
		$connect->query($removePedidoSucursalSql);	
	} // /for quantity

	// insert the pedidoSucursal item data 
	for($x = 0; $x < count($_POST['productName']); $x++) {			
		// add into pedidoSucursal_item
		$pedidoSucursalItemSql = "INSERT INTO pedido_producto_sucursal (pedido_sucursal_id, product_id, quantity, rate, total, pedido_producto_sucursal_status) 
		VALUES ({$pedidoSucursalId}, '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

		$connect->query($pedidoSucursalItemSql);
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Actualizado exitosamente";

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);