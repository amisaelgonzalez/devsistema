<?php 	

require_once '../config/core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$solicitudesId = $_POST['solicitudId'];

if($solicitudesId) { 

 $sql = "UPDATE solicitudes SET solicitudes_status = 2 WHERE solicitudes_id = {$solicitudesId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Cancelado exitosamente";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error no se ha podido cancelado";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST