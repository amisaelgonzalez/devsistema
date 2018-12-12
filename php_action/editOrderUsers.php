<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$orderId = $_POST['orderId'];

	$orderDate 		= date('d/m/Y', strtotime($_POST['orderDate']));

	$clientName 	= $_POST['clientName'];
	$clientContact 	= $_POST['clientContact'];
	$colina 	    = $_POST['colina'];
	$calle      	= $_POST['calle'];
	$ciudad 		= $_POST['ciudad'];
	$subTotalValue 	= $_POST['subTotalValue'];
	$vatValue 		= $_POST['vatValue'];
	$totalAmountValue= $_POST['totalAmountValue'];
	$discount 	    = $_POST['discount'];
	$grandTotalValue= $_POST['grandTotalValue'];
	$paid 			= $_POST['paid'];
	$dueValue 		= $_POST['dueValue'];
	$paymentType 	= $_POST['paymentType'];
	$paymentStatus  = $_POST['paymentStatus'];

		
	$sql = "UPDATE orders_user SET order_date = '$orderDate', client_name = '$clientName', client_contact = '$clientContact', colina = '$colina', calle = '$calle', ciudad = '$ciudad', sub_total = '$subTotalValue', vat = '$vatValue', total_amount = '$totalAmountValue', discount = '$discount', grand_total = '$grandTotalValue', paid = '$paid', due = '$dueValue', payment_type = '$paymentType', payment_status = '$paymentStatus', order_status = 1 WHERE order_id = {$orderId}";	
	$connect->query($sql);
		
	// remove the order item data from order item table
	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$removeOrderSql = "DELETE FROM order_user_item WHERE order_id = {$orderId}";
		$connect->query($removeOrderSql);	
	} // /for quantity

	// insert the order item data 
	for($x = 0; $x < count($_POST['productName']); $x++) {			
		// add into order_item
		$orderItemSql = "INSERT INTO order_user_item (order_id, product_id, quantity, rate, total, order_item_status) 
		VALUES ({$orderId}, '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

		$connect->query($orderItemSql);
	} // /for quantity


	$valid['success'] = true;
	$valid['messages'] = "Actualizado exitosamente";	
		
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);