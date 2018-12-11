<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'pedidoSucursal_id' => '');
// print_r($valid);
if($_POST) {
    $detalle 	= $_POST['detalle'];

	$subTotalValue 	= $_POST['subTotalValue'];
	$vatValue 		=	$_POST['vatValue'];
	$totalAmountValue = $_POST['totalAmountValue'];

	$userId = $_SESSION['userId'];
	$sucursales_id = $_SESSION['sucursales_id'];

	$sql = "INSERT INTO pedido_sucursal (pedido_sucursal_date, detalle, sub_total, vat, total, pedido_sucursal_status, user_id, sucursales_id) VALUES (NOW(), '$detalle', '$subTotalValue', '$vatValue', '$totalAmountValue', 1, '$userId', '$sucursales_id')";
		
	$pedidoSucursal_id;
	$pedidoSucursalStatus = false;
	if($connect->query($sql) === true) {
		$pedidoSucursal_id = $connect->insert_id;
		$valid['pedidoSucursal_id'] = $pedidoSucursal_id;	

		$pedidoSucursalStatus = true;
	}
		
	// echo $_POST['productName'];
	$pedidoSucursalItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);

		// add into pedidoSucursal_item
		$pedidoSucursalItemSql = "INSERT INTO pedido_producto_sucursal (pedido_sucursal_id, product_id, quantity, rate, total, pedido_producto_sucursal_status) 
		VALUES ('$pedidoSucursal_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

		$connect->query($pedidoSucursalItemSql);		

		if($x == count($_POST['productName'])) {
			$pedidoSucursalItemStatus = true;
		}		
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Agregado exitosamente";


	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);