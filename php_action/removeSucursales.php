<?php 	

require_once '../config/core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$sucursalesId = $_POST['sucursalesId'];

if($sucursalesId) { 

 $sql = "UPDATE sucursales SET sucursales_status = 2 WHERE sucursales_id = {$sucursalesId}";

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