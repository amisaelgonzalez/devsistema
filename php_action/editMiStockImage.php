<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {		

$miStockId = $_POST['miStockId'];
 
$type = explode('.', $_FILES['editMiStockImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['editMiStockImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['editMiStockImage']['tmp_name'], $url)) {

				$sql = "UPDATE stock SET product_image = '$url' WHERE stock_id = $miStockId";				

				if($connect->query($sql) === TRUE) {									
					$valid['success'] = true;
					$valid['messages'] = "Actualizado exitosamente";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error no se ha podido actualizar";
				}
			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST