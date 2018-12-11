<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$sucursalesCredito = $_POST['editSucursalesCredito'];
	$sucursalesFechaLimite = date('Y-m-d', strtotime($_POST['editSucursalesFechaLimite']));

	$sucursalesCreditoAct = $_POST['sucursalesCreditoAct'];
	//$sucursalesFechaLimiteAct = $_POST['SucursalesFechaLimiteAct'];

    $sucursalesId = $_POST['sucursalesId'];

   	$resultSum = $sucursalesCredito + $sucursalesCreditoAct;

	$sql = "UPDATE sucursales SET sucursales_creditos = '$resultSum', sucursales_fecha_limite = '$sucursalesFechaLimite' WHERE sucursales_id = '$sucursalesId'";

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