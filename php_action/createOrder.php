<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

	$orderDate 		= date('Y-m-d', strtotime($_POST['orderDate']));	
    $clientName 	= $_POST['clientName'];
	$clientContact 	= $_POST['clientContact'];
	$subTotalValue 	= $_POST['subTotalValue'];
	$vatValue 		=	$_POST['vatValue'];
	$totalAmountValue = $_POST['totalAmountValue'];
	$discount 		= $_POST['discount'];
	$grandTotalValue= $_POST['grandTotalValue'];
	$paid 			= $_POST['paid'];
	$dueValue 		= $_POST['dueValue'];
	$paymentType 	= $_POST['paymentType'];
	$paymentStatus 	= $_POST['paymentStatus'];

	
	$sqlCanSuc = "SELECT sucursales_creditos FROM sucursales WHERE sucursales_id = $clientName";
	$result = $connect->query($sqlCanSuc);

	if($result->num_rows > 0) { 
		$row = $result->fetch_array();
		if ($row[0] >= $totalAmountValue) {

			$sql = "INSERT INTO orders (order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_type, payment_status, order_status) VALUES ('$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentType, $paymentStatus, 1)";
			
			
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
				$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
				$updateProductQuantityData = $connect->query($updateProductQuantitySql);
				
				
				while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
					$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
						// update product table
						$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
						$connect->query($updateProductTable);

						// add into order_item
						$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, rate, total, order_item_status) 
						VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

						$connect->query($orderItemSql);		

						if($x == count($_POST['productName'])) {
							$orderItemStatus = true;
						}		
				} // while	
			} // /for quantity

			$sql2 = "UPDATE sucursales SET sucursales_creditos = sucursales_creditos-'$totalAmountValue' WHERE sucursales_id='$clientName'";
			$connect->query($sql2);

			$valid['success'] = true;
			$valid['messages'] = "Agregado exitosamente";
		} // $row[0]
		else {
			$valid['success'] = false;
			$valid['messages'] = "La sucursal no tiene suficientes créditos";
		}
	} // if num_rows
	else {
		$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido guardar";
	}	
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);