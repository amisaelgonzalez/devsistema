<?php 	

require_once '../config/core.php';

$sql = "SELECT c.creditos_id, u.username, s.sucursales_name, c.creditos_cantidad, c.creditos_fecha_limite FROM creditos c INNER JOIN sucursales s ON s.sucursales_id = c.sucursales_id INNER JOIN users u ON c.user_id = u.user_id WHERE c.creditos_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();

 while($row = $result->fetch_array()) {

 	$creditosId = $row[0];

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeCreditos('.$creditosId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1],
 		$row[2],
 		$row[3],
 		$row[4],
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);