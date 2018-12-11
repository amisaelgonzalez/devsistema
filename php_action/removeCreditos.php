<?php 	

require_once '../config/core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$creditosId = $_POST['creditosId'];

if($creditosId) { 

	$sql = "SELECT creditos_cantidad, sucursales_id FROM creditos WHERE creditos_id = '$creditosId'";

	$result = $connect->query($sql);
	if($result->num_rows > 0) { 
		$row = $result->fetch_array();
		$sql1 = "UPDATE creditos SET creditos_status = 2 WHERE creditos_id = {$creditosId}";

		$sql2 = "UPDATE sucursales SET sucursales_creditos = sucursales_creditos-'$row[0]' WHERE sucursales_id='$row[1]'";

		if($connect->query($sql1) === TRUE) {
			if($connect->query($sql2) === TRUE) {
			 	$valid['success'] = true;
				$valid['messages'] = "Eliminado exitosamente";		
			} else {
			 	$valid['success'] = false;
			 	$valid['messages'] = "Error no se ha podido eliminar";
			}
		} else {
		 	$valid['success'] = false;
		 	$valid['messages'] = "Error no se ha podido eliminar";
		}
	} // if num_rows

 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST