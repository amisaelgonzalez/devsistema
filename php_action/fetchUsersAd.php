<?php 	

require_once '../config/core.php';
$user_id = $_SESSION['userId'];

$sql = "SELECT u.user_id, u.username, u.email, u.rol, u.users_status, u.sucursales_id, su.sucursales_name FROM users u LEFT JOIN sucursales su ON u.sucursales_id = su.sucursales_id WHERE u.rol = 3 AND u.creado_por = '$user_id'";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeUsersAd = ""; 
 $rolUsersAd = "";

 while($row = $result->fetch_array()) {
 	$usersAdId = $row[0];


 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editUsersAdModel" onclick="editUsersAd('.$usersAdId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>';

	// rol
	$rolUsersAd = "usuario";

 	// active 
 	if($row[4] == 1) {
 		// activate member
 		$activeUsersAd = "<label class='label label-success'>Activo</label>";

		$button .= '<li><a type="button" data-toggle="modal" data-target="#editPassUsersAdModel" onclick="editPassUsersAd('.$usersAdId.')"> <i class="glyphicon glyphicon-cog"></i> Cambiar password </a></li>
			<li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeUsersAd('.$usersAdId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>
		  </ul>
		</div>';

 	} else {
 		// deactivate member
 		$activeUsersAd = "<label class='label label-danger'>Eliminado</label>";
 		$button .= '<li><a type="button" data-toggle="modal" data-target="#activeMemberModal" onclick="activeUsersAd('.$usersAdId.')"> <i class="glyphicon glyphicon-ok"></i> Activar </a></li>
		  </ul>
		</div>';
 	}

 	$output['data'][] = array( 		
 		$row[1], 
 		$row[2],
 		$rolUsersAd,
 		$activeUsersAd,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);