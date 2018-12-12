<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$miStockId = $_POST['miStockId'];
	$cantidad = $_POST['cantidad']; 
	$user_id = $_SESSION['userId'];
  	
  	$sqlPs = "SELECT stock_id, product_name, product_image, brand_id, categories_id, quantity, rate, status FROM stock WHERE stock_id = $miStockId";
	$resultPs = $connect->query($sqlPs);

	if($resultPs->num_rows > 0) { 
		$rowPs = $resultPs->fetch_array();
	  	$miStockName 	= $rowPs['product_name'];
	  	$priceMenudeo   = $rowPs['rate'];
	  	$brandName 		= $rowPs['brand_id'];
	  	$categoryName 	= $rowPs['categories_id'];
		$url      	    = $rowPs['product_image'];
	} // if num_rows

	$sqlupd = "UPDATE stock SET quantity = quantity-'$cantidad' WHERE stock_id = $miStockId";
	$connect->query($sqlupd);

				
	$sql = "INSERT INTO stock_users (user_id, product_id, brand_id, categories_id, product_name, product_image, quantity, rate, status) VALUES ('$user_id', 1, '$brandName', '$categoryName', '$miStockName', '$url', '$cantidad', '$priceMenudeo', 1)";
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Agregado exitosamente";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error no se ha podido guardar";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
