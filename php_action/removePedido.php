<?php 	

require_once '../config/core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$pedidoId = $_POST['pedidoId'];

if($pedidoId) { 

 $sql = "UPDATE pedidos SET pedido_status = 2 WHERE pedido_id = {$pedidoId}";

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