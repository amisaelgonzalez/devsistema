<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$productId = $_POST['productId'];
	$productName	= $_POST['editProductName']; 
    $quantity 		= $_POST['editQuantity'];
    $priceMayoreo	= $_POST['editPriceMayoreo'];
    $priceMenudeo	= $_POST['editPriceMenudeo'];
    $brandName 		= $_POST['editBrandName'];
    $categoryName 	= $_POST['editCategoryName'];
    $productStatus 	= $_POST['editProductStatus'];

				
	$sql = "UPDATE product SET product_name = '$productName', brand_id = '$brandName', categories_id = '$categoryName', quantity = '$quantity', price_mayoreo = '$priceMayoreo', rate = '$priceMenudeo', active = '$productStatus', status = 1 WHERE product_id = $productId ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Actualizado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido actualizar";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
