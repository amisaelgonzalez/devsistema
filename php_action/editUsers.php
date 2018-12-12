<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$usersName = $_POST['editUsersName'];
    //$usersStatus = $_POST['editUsersStatus'];
    $usersEmail = $_POST['editEmail'];
    $usersRol = $_POST['editRol'];
    $usersId = $_POST['usersId'];

    switch ($usersRol) {
		case '1':
    		$editSucursal = null;
			break;
		case '4':
    		$editSucursal = null;
			break;
		default:
		    $editSucursal = $_POST['editSucursal'];
			break;	
	}


    $usersName = strtolower($usersName);

    $sqlUsername = "SELECT * FROM users WHERE username = '$usersName' and user_id != $usersId";
	$result = $connect->query($sqlUsername);

	if($result->num_rows > 0) { 
		$valid['success'] = false;
		$valid['messages'] = "Error el usuario ya existe";
	} else {

		$sql = "UPDATE users SET username = '$usersName', email = '$usersEmail', rol = '$usersRol', sucursales_id = '$editSucursal' WHERE user_id = '$usersId'";

		if($connect->query($sql) === TRUE) {
		 	$valid['success'] = true;
			$valid['messages'] = "Actualizado exitosamente";	
		} else {
		 	$valid['success'] = false;
		 	$valid['messages'] = "Error no se ha podido actualizar";
		}

	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST