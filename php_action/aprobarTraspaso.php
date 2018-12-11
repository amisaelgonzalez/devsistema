<?php 	

require_once '../config/core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$solicitudesId = 2;//$_POST['solicitudId'];

if($solicitudesId) { 

	$sqlCant = "SELECT st.quantity, s.cantidad, s.sucursal_pedido_id, st.product_id, st.brand_id , st.categories_id, st.product_name, st.product_image, st.rate, st.stock_id FROM solicitudes s INNER JOIN stock st ON st.stock_id  = s.stock_id WHERE solicitudes_id = $solicitudesId";
	$result = $connect->query($sqlCant);

	if($result->num_rows > 0) { 
		$row = $result->fetch_array();
		if ($row[0] >= $row[1]) {

		$sqlAprobarSolcitud = "UPDATE solicitudes SET solicitudes_status = 3 WHERE solicitudes_id = {$solicitudesId}";

		$sqlUpdate = "UPDATE stock SET quantity = quantity-$row[1] WHERE stock_id = {$row[9]}";

		$sqlInsert = "INSERT INTO stock (sucursales_id, product_id, brand_id, categories_id, product_name, product_image, quantity, rate, status) VALUES ('$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]', '$row[1]', '$row[8]', 1)";

			if($connect->query($sqlAprobarSolcitud) === TRUE AND $connect->query($sqlUpdate) === TRUE AND $connect->query($sqlInsert) === TRUE) {
			 	$valid['success'] = true;
				$valid['messages'] = "Aprobado exitosamente";		
			} else {
			 	$valid['success'] = false;
			 	$valid['messages'] = "Error no se ha podido aprobar";
			}

		}else{
			//cantidad no disponible
			$valid['success'] = false;
		 	$valid['messages'] = "Error la cantidad no está disponible";
		}
	}else{
		//no encontrado
		$valid['success'] = false;
		$valid['messages'] = "Error problemas al encontrar el registro";
	}
 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST