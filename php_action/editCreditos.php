<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$creditosCantidad = $_POST['editCreditosCantidad'];
	$creditosFechaLimite = date('Y-m-d', strtotime($_POST['editCreditosFechaLimite']));
  	$SucursalId = $_POST['editSucursalId']; 
  	$creditosId = $_POST['creditosId'];

  	if ($_SESSION['userId']) {
  		$user_id = $_SESSION['userId'];

		$sql = "UPDATE creditos SET creditos_cantidad = '$creditosCantidad', Sucursales_id = '$SucursalId', creditos_fecha_limite = '$creditosFechaLimite', user_id = '$user_id' WHERE creditos_id = '$creditosId'";
	}
	
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