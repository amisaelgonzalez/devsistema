<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$miStockId = $_POST['miStockId'];
	$cantidad = $_POST['cantidad']; 
				
	$sql = "UPDATE stock SET quantity = quantity-'$cantidad' WHERE stock_id = $miStockId";

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
 
