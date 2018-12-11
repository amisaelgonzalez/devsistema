<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$orderId = $_POST['orderId'];

	$orderDate 		= date('Y-m-d', strtotime($_POST['orderDate']));

	$totalAct  	    = $_POST['totalAmountValueAct'];
	$clientNameAct  = $_POST['clientNameAct'];

	$clientName 	= $_POST['clientName'];
	$clientContact 	= $_POST['clientContact'];
	$subTotalValue 	= $_POST['subTotalValue'];
	$vatValue 		= $_POST['vatValue'];
	$totalAmountValue= $_POST['totalAmountValue'];
	$discount 	    = $_POST['discount'];
	$grandTotalValue= $_POST['grandTotalValue'];
	$paid 			= $_POST['paid'];
	$dueValue 		= $_POST['dueValue'];
	$paymentType 	= $_POST['paymentType'];
	$paymentStatus  = $_POST['paymentStatus'];

	if ($clientNameAct == $clientName) {
		$sqlCanSuc = "SELECT sucursales_creditos FROM sucursales WHERE sucursales_id = $clientName";
		$result = $connect->query($sqlCanSuc);
	}else{
		$sqlCanSuc = "SELECT sucursales_creditos FROM sucursales WHERE sucursales_id = $clientName";
		$result = $connect->query($sqlCanSuc);
	}

	if($result->num_rows > 0) { 
		$row = $result->fetch_array();
		if ($clientNameAct == $clientName) {
			$sum = $totalAct + $row[0];
		}else{
			$sum = $row[0];
		}
		if ($sum >= $totalAmountValue) {
		
			$sql = "UPDATE orders SET order_date = '$orderDate', client_name = '$clientName', client_contact = '$clientContact', sub_total = '$subTotalValue', vat = '$vatValue', total_amount = '$totalAmountValue', discount = '$discount', grand_total = '$grandTotalValue', paid = '$paid', due = '$dueValue', payment_type = '$paymentType', payment_status = '$paymentStatus', order_status = 1 WHERE order_id = {$orderId}";	
			$connect->query($sql);
			
			$readyToUpdateOrderItem = false;
			// add the quantity from the order item to product table
			for($x = 0; $x < count($_POST['productName']); $x++) {		
				//  product table
				$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
				$updateProductQuantityData = $connect->query($updateProductQuantitySql);			
					
				while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
					// order item table add product quantity
					$orderItemTableSql = "SELECT order_item.quantity FROM order_item WHERE order_item.order_id = {$orderId}";
					$orderItemResult = $connect->query($orderItemTableSql);
					$orderItemData = $orderItemResult->fetch_row();

					$editQuantity = $updateProductQuantityResult[0] + $orderItemData[0];							

					$updateQuantitySql = "UPDATE product SET quantity = $editQuantity WHERE product_id = ".$_POST['productName'][$x]."";
					$connect->query($updateQuantitySql);		
				} // while	
				
				if(count($_POST['productName']) == count($_POST['productName'])) {
					$readyToUpdateOrderItem = true;			
				}
			} // /for quantity

			// remove the order item data from order item table
			for($x = 0; $x < count($_POST['productName']); $x++) {			
				$removeOrderSql = "DELETE FROM order_item WHERE order_id = {$orderId}";
				$connect->query($removeOrderSql);	
			} // /for quantity

			if($readyToUpdateOrderItem) {
					// insert the order item data 
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
						VALUES ({$orderId}, '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

						$connect->query($orderItemSql);		
					} // while	
				} // /for quantity
			}

			if ($clientNameAct == $clientName) {
				$restar = $sum - $totalAmountValue;
				$restarCreditoSql = "UPDATE sucursales SET sucursales_creditos = '$restar' WHERE sucursales_id='$clientNameAct'";
				$connect->query($restarCreditoSql);
			}else{
				$sumCreditoActSql = "UPDATE sucursales SET sucursales_creditos = sucursales_creditos+'$totalAct' WHERE sucursales_id='$clientNameAct'";

				$restarCreditoSql = "UPDATE sucursales SET sucursales_creditos = sucursales_creditos-'$totalAmountValue' WHERE sucursales_id='$clientName'";

				$connect->query($sumCreditoActSql);
				$connect->query($restarCreditoSql);
			}


			$valid['success'] = true;
			$valid['messages'] = "Actualizado exitosamente";

		}else{
			$valid['success'] = false;
			$valid['messages'] = "La sucursal no tiene suficientes créditos";
		}
	}else{
		$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido guardar";		
	}		
		
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);