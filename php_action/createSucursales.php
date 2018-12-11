<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$sucursalesName = $_POST['sucursalesName'];
	//$sucursalesCredito = $_POST['sucursalesCredito'];

	//$sucursalesFechaLimite = date('Y-m-d', strtotime($_POST['sucursalesFechaLimite']));
	
	$sql = "INSERT INTO sucursales (sucursales_name, sucursales_status, sucursales_creditos) VALUES ('$sucursalesName', 1, 0)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Creado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido guardar";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST