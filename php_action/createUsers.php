<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$usersName = $_POST['usersName'];
	$password = md5($_POST['password']);
    $usersEmail = $_POST['email'];
    $usersRol = $_POST['rol'];
	$sucursal =  $_POST['sucursal'];
	switch ($usersRol) {
		case '1':
    		$sucursal = null;
			break;
		
		case '4':
    		$sucursal = null;
			break;
	}

    $user_id = $_SESSION['userId'];
    $usersName = strtolower($usersName);

    $sqlUsername = "SELECT * FROM users WHERE username = '$usersName'";
	$result = $connect->query($sqlUsername);

	if($result->num_rows > 0) { 
		$valid['success'] = false;
		$valid['messages'] = "Error el usuario ya existe";
	} else {

		$sql = "INSERT INTO users (username, password, users_status, email, rol, sucursales_id, creado_por) VALUES ('$usersName', '$password', 1, '$usersEmail', '$usersRol', '$sucursal', '$user_id')";

		if($connect->query($sql) === TRUE) {
		 	$valid['success'] = true;
			$valid['messages'] = "Creado exitosamente";	
		} else {
		 	$valid['success'] = false;
		 	$valid['messages'] = "Error no se ha podido guardar";
		}

	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST