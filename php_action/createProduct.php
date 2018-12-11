<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

  	$productName 	= $_POST['productName'];
  // $productImage 	= $_POST['productImage'];
 	$quantity 		= $_POST['quantity'];
 	$priceMayoreo   = $_POST['priceMayoreo'];
  	$priceMenudeo   = $_POST['priceMenudeo'];
  	$brandName 		= $_POST['brandName'];
  	$categoryName 	= $_POST['categoryName'];
  	$productStatus 	= $_POST['productStatus'];

	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
				
				$sql = "INSERT INTO product (product_name, product_image, brand_id, categories_id, quantity, price_mayoreo, rate, active, status) 
				VALUES ('$productName', '$url', '$brandName', '$categoryName', '$quantity', '$priceMayoreo', '$priceMenudeo', '$productStatus', 1)";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Creado exitosamente";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error no se ha podido guardar";
				}

			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST