<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

	$orderDate 		= date('Y-m-d', strtotime($_POST['orderDate']));	
    $clientName 	= $_POST['clientName'];

	$clientContact 	= $_POST["clientContact"];
	$colonia		= $_POST["colina"];
	$calle  		= $_POST["calle"];
	$ciudad			= $_POST["ciudad"];

	$subTotalValue 	= $_POST['subTotalValue'];
	$vatValue 		=	$_POST['vatValue'];
	$totalAmountValue = $_POST['totalAmountValue'];
	$discount 		= $_POST['discount'];
	$grandTotalValue= $_POST['grandTotalValue'];
	$paid 			= $_POST['paid'];
	$dueValue 		= $_POST['dueValue'];
	$paymentType 	= $_POST['paymentType'];
	$paymentStatus 	= $_POST['paymentStatus'];


	$sql = "INSERT INTO orders_user (order_date, client_name, client_contact, colina, calle, ciudad, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_type, payment_status, order_status) VALUES ('$orderDate', '$clientName', '$clientContact', '$colonia', '$calle', '$ciudad', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentType, $paymentStatus, 1)";
	
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			

		// add into order_item
		$orderItemSql = "INSERT INTO order_user_item (order_id, product_id, quantity, rate, total, order_item_status) 
		VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

		$connect->query($orderItemSql);		

		if($x == count($_POST['productName'])) {
			$orderItemStatus = true;
		}
	} // /for add order_item

	$valid['success'] = true;
	$valid['messages'] = "Agregado exitosamente";	
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);