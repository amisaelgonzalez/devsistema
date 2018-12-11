<?php 	

require_once '../config/core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$miStockId = $_POST['miStockId'];

if($miStockId) { 

 $sql = "UPDATE stock SET status = 2 WHERE stock_id = {$miStockId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Eliminado exitosamente";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error no se ha podido eliminar";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST