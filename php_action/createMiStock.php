<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$sucursales_id = $_SESSION['sucursales_id'];
  	
  	$miStockName 	= $_POST['miStockName'];
  // $miStockImage 	= $_POST['miStockImage'];
 	$quantity 		= $_POST['quantity'];
  	$priceMenudeo   = $_POST['priceMenudeo'];
  	$brandName 		= $_POST['brandName'];
  	$categoryName 	= $_POST['categoryName'];
//  	$miStockStatus 	= $_POST['miStockStatus'];

	$type = explode('.', $_FILES['miStockImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['miStockImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['miStockImage']['tmp_name'], $url)) {
				
				$sql = "INSERT INTO stock (sucursales_id, product_id, brand_id, categories_id, product_name, product_image, quantity, rate, status) VALUES ('$sucursales_id', 1, '$brandName', '$categoryName', '$miStockName', '$url', '$quantity', '$priceMenudeo', 1)";

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