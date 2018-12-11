<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$sucursalesName = $_POST['editSucursalesName'];
    $sucursalesId = $_POST['sucursalesId'];

	$sql = "UPDATE sucursales SET sucursales_name = '$sucursalesName' WHERE sucursales_id = '$sucursalesId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Actualizado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido actualizar";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST