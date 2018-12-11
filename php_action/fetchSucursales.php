<?php 	

require_once '../config/core.php';

$sql = "SELECT sucursales_id, sucursales_name, sucursales_creditos FROM sucursales WHERE sucursales_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$sucursalesId = $row[0];

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editSucursalesModel" onclick="editSucursales('.$sucursalesId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeSucursales('.$sucursalesId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1],
 		$row[2],
 		$button
 		);
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);