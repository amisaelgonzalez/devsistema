<?php 	

require_once '../config/core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$usersAdId = $_POST['usersAdId'];

//if($usersAdId) { 

 $sql = "UPDATE users SET users_status = 1 WHERE user_id = {$usersAdId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Activado exitosamente";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error no se ha podido activar";
 }
 
 $connect->close();

 echo json_encode($valid);
 
//} // /if $_POST