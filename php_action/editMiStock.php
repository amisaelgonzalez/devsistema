<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$miStockId = $_POST['miStockId'];
	$miStockName	= $_POST['editMiStockName']; 
    $quantity 		= $_POST['editQuantity'];
    $priceMenudeo	= $_POST['editPriceMenudeo'];
    $brandName 		= $_POST['editBrandName'];
    $categoryName 	= $_POST['editCategoryName'];
//    $miStockStatus 	= $_POST['editMiStockStatus'];

				
	$sql = "UPDATE stock SET product_name = '$miStockName', brand_id = '$brandName', categories_id = '$categoryName', quantity = '$quantity', rate = '$priceMenudeo' WHERE stock_id = $miStockId ";

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
 
