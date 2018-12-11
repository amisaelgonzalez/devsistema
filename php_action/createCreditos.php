<?php 
require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST && $_SESSION['userId']) {

	$creditosCantidad = $_POST['creditosCantidad'];
	$creditosFechaLimite = date('Y-m-d', strtotime($_POST['creditosFechaLimite']));
  	$sucursalId = $_POST['sucursalId'];
	$user_id = $_SESSION['userId'];

	$sql = "INSERT INTO creditos (creditos_cantidad, sucursales_id, creditos_fecha_limite, user_id, creditos_status) VALUES ('$creditosCantidad', '$sucursalId', '$creditosFechaLimite', '$user_id', 1)";

	$sql1 = "UPDATE sucursales SET sucursales_creditos = sucursales_creditos+'$creditosCantidad' WHERE sucursales_id='$sucursalId'";

	if($connect->query($sql) === TRUE) {
		if($connect->query($sql1) === TRUE) {
		 	$valid['success'] = true;
			$valid['messages'] = "Creado exitosamente";		
		} else {
		 	$valid['success'] = false;
		 	$valid['messages'] = "Error no se ha podido guardar";
		}
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido guardar";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST