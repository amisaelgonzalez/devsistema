<?php 	

require_once '../config/core.php';

$sql = "SELECT u.user_id, u.username, u.email, u.rol, u.users_status, u.sucursales_id, su.sucursales_name FROM users u LEFT JOIN sucursales su ON u.sucursales_id = su.sucursales_id";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeUsers = ""; 
 $rolUsers = "";

 while($row = $result->fetch_array()) {
 	$usersId = $row[0];


 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editUsersModel" onclick="editUsers('.$usersId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>';

	$sucursalUsers = "";

	// rol
	if ($row[3] == 1) {
		$rolUsers = "Super admin";
	}elseif ($row[3] == 2) {
		$rolUsers = "Administrador sucursal";
		// sucursal 
		$sucursalUsers = $row[6];		
	}elseif ($row[3] == 3) {
		$rolUsers = "Usuario";
	}elseif ($row[3] == 4) {
		$rolUsers = "Adminstrador créditos";
	}

 	// active 
 	if($row[4] == 1) {
 		// activate member
 		$activeUsers = "<label class='label label-success'>Activo</label>";

		$button .= '<li><a type="button" data-toggle="modal" data-target="#editPassUsersModel" onclick="editPassUsers('.$usersId.')"> <i class="glyphicon glyphicon-cog"></i> Cambiar password </a></li>
			<li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeUsers('.$usersId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>
		  </ul>
		</div>';

 	} else {
 		// deactivate member
 		$activeUsers = "<label class='label label-danger'>Eliminado</label>";
 		$button .= '<li><a type="button" data-toggle="modal" data-target="#activeMemberModal" onclick="activeUsers('.$usersId.')"> <i class="glyphicon glyphicon-ok"></i> Activar </a></li>
		  </ul>
		</div>';
 	}

 	$output['data'][] = array( 		
 		$row[1], 
 		$row[2],
 		$rolUsers,
 		$sucursalUsers,
 		$activeUsers,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);