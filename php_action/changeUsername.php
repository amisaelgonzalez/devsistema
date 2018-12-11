<?php 

require_once '../config/core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$username = $_POST['username'];
	$userId = $_POST['user_id'];
	$username = strtolower($username);

    $sqlUsername = "SELECT * FROM users WHERE username = '$username'";
	$result = $connect->query($sqlUsername);

	if($result->num_rows > 0) { 
		$valid['success'] = false;
		$valid['messages'] = "Error el usuario ya existe";
	} else {

		$sql = "UPDATE users SET username = '$username' WHERE user_id = {$userId}";
		if($connect->query($sql) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "Actualizado exitosamente";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error no se pudo actualizar los datos";
		}

	}

	$connect->close();

	echo json_encode($valid);

}

?>